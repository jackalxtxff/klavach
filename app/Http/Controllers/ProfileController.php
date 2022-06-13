<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Game;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $username
     * @return \Illuminate\Http\Response
     */
    public function showSettings($username) {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            abort(404);
        }

        return view('user.pages.profile.settings', [
            'user' => $user
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $username
     * @return \Illuminate\Http\Response
     */
    public function showHistory($username) {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            abort(404);
        }

        $games = Game::where('user_id', $user->id)
            ->with(['dictionary' => function($q) { $q->withTrashed(); }], 'dictionary.user')
            ->limit(50)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($game) {
                return Carbon::parse($game->created_at)->format('M d Y');
            });

//        dd($games);

        return view('user.pages.profile.history.history', [
            'games' => $games,
            'user' => $user
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $username
     * @return \Illuminate\Http\Response
     */
    public function showStats($username) {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            abort(404);
        }

        return view('user.pages.profile.stats.stats', [
            'user' => $user
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $username
     * @return \Illuminate\Http\Response
     */
    public function index(string $username)
    {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            abort(404);
        }

        $countGames = Game::selectRaw('count(id) as count, user_id, dictionary_id')
            ->groupBy('user_id', 'dictionary_id')
            ->having('user_id', $user->id)
            ->orderBy('count', 'desc')
            ->first();

        $profiles = Profile::orderBy('avg_speed', 'DESC')->get();
        for ($i = 0; $i < count($profiles); $i++) {
            if ($profiles[$i]->id == $user->id) {
                $place = $i + 1;
            }
        }

        if (!isset($countGames)) {
            $favDictionary = [];
        }
        else {
            $favDictionary = Dictionary::withTrashed()->find($countGames->dictionary_id);
        }

//        dd($favDictionary);

        return view('user.pages.profile.profile', [
            'user' => $user,
            'place' => $place,
            'dictionary' => $favDictionary
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            abort(404);
        }
        if (Auth::check()) {
            if ($username === Auth::user()->name) {
                return $this->index();
            }
            else {
                dd($user);
            }
        }
        else {
            dd($user);
        }

//        dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $username
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            return abort(404);
        }

        if ($user->cannot('update', Auth::user())) {
            return redirect()->back();
        }

        return view('user.pages.profile.settings', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->cannot('update', Auth::user())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Недостаточно прав!'
            ], 422);
        }

        if ($request->ajax()) {

            if (empty($user)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Пользователь не найден'
                ], 422);
            }

            if (isset($request->name)) {
                if ($user->name == $request->name) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Без изменений!'
                    ]);
                }

                $lastName = $user->name;

                $errors = Validator::make($request->all(), [
                    'name' => 'required|string|min:5|max:20|unique:users|regex:/^[a-zA-Z0-9]+$/'
                ]);
            }
            else if ($request->about) {
                if ($user->profile->about == $request->about) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Без изменений!'
                    ]);
                }

                $errors = Validator::make($request->all(), [
                    'about' => 'required|string|max:255'
                ]);
            }
            else if (isset($request->current_password) || isset($request->new_password)) {
                $errors = Validator::make($request->all(), [
                    'current_password' => ['required', 'password'],
                    'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
                    'new_password_confirmation' => ['required_with:new_password', 'same:new_password']
                ]);
            }
            else if ($request->file('image')) {
                $errors = Validator::make($request->all(), [
                    'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
                ]);
            }
            else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Без изменений!'
                ]);
            }

            if ($errors->fails()) {
                return response()->json([
                    'errors' => $errors->errors(),
                    'message' => 'Указанные данные недействительны.'
                ], 422);
            }

            if (isset($request->name)) {
                $user->update([
                    'name' => $request->name
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Данные обновлены!',
                    'lastname' => $lastName
                ]);
            }
            else if (isset($request->about)) {
                $user->profile->update([
                    'about' => $request->about == "*null*" ? null : $request->about
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Данные обновлены!'
                ]);
            }
            else if (isset($request->current_password) || isset($request->new_password)) {
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Данные обновлены!'
                ]);
            }
            else if ($request->file('image')) {
                if ($user->profile->photo != null) {
                    Storage::delete($user->profile->local_photo);
                }

                $local_path = $request->file('image')->store('public/users/' . $user->id);
                $path = Storage::url($local_path);

                $user->profile()->update([
                    'photo' => $path,
                    'local_photo' => $local_path
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Данные обновлены!'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->cannot('delete', Auth::user())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Недостаточно прав!'
            ], 422);
        }

        Storage::delete($user->profile->local_photo);

        $user->profile()->update([
            'photo' => null
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Аватар удален!'
        ]);
    }
}
