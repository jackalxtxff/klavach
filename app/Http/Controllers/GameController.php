<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Excerpt;
use App\Models\Game;
use App\Models\Profile;
use App\Models\Stats;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function getDictionary(Request $request) {
        $dictionary = Dictionary::find($request->dictionary);

        if ($dictionary->type_id == 1) {
            $dictionary = Dictionary::where('id', $request->dictionary)
                ->with('language')
                ->with('excerpts')
                ->first();

            $excerpt = Excerpt::where('dictionary_id', $request->dictionary)
                ->inRandomOrder()
                ->first();

            $excerpttemp = explode(' ', $dictionary->excerpts[0]->excerpt);
            $newarr = [];
            $excerpts = [];
            $tempstr = "";

            while (Str::of($tempstr)->length() < 200) {
                $randarr = $excerpttemp[array_rand($excerpttemp, 1)];
                $tempstr = Str::of($tempstr)->append($randarr);
                array_push($newarr, $randarr);
            }

            Arr::shuffle($newarr);

            $newarr = implode(" ", $newarr);

            $excerpt->excerpt = $newarr;
            array_push($excerpts, $excerpt);
        }
        else if ($dictionary->type_id == 2) {
            $dictionary = Dictionary::where('id', $request->dictionary)
                ->with('language')
                ->with('excerpts')
                ->first();

            $tempstr = "";
            $excerpts = [];
            while (Str::of($tempstr)->length() < 200) {
                $excerpt = Excerpt::where('dictionary_id', $request->dictionary)
                    ->inRandomOrder()
                    ->first();
                $tempstr = Str::of($tempstr)->append($excerpt->excerpt);
                array_push($excerpts, $excerpt);
            }
        }
        else if ($dictionary->type_id == 3) {
            $dictionary = Dictionary::where('id', $request->dictionary)
                ->with('language')
                ->with('excerpts')
                ->first();

            $tempstr = "";
            $excerpts = [];
            while (Str::of($tempstr)->length() < 200) {
                $excerpt = Excerpt::where('dictionary_id', $request->dictionary)
                    ->inRandomOrder()
                    ->first();
                $tempstr = Str::of($tempstr)->append($excerpt->excerpt);
                array_push($excerpts, $excerpt);
            }
        }

        return response()->json([
            'dictionary' => $dictionary,
            'excerpts' => $excerpts
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dictionary = Dictionary::with('user')
            ->with('language')
            ->inRandomOrder()
            ->first();

        return view('user.pages.training.training', [
            'dictionary' => $dictionary
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax())
        {
            if (Auth::user()) {
                $game = Game::create([
                    'user_id' => Auth::id(),
                    'dictionary_id' => $request->dictionary,
                    'avg_speed' => $request->avg_speed,
                    'count_mistakes' => $request->count_mistakes,
                    'percent_mistakes' => $request->percent_mistakes
                ]);

                $dictionary = Dictionary::find($game->dictionary_id);

                $stats = $dictionary->stats()->update([
                    'count_games' => Game::where('dictionary_id', $game->dictionary_id)->count(),
                    'avg_speed' => Game::where('dictionary_id', $game->dictionary_id)->avg('avg_speed'),
                    'count_mistakes' => Game::where('dictionary_id', $game->dictionary_id)->avg('count_mistakes'),
                    'percent_mistakes' => Game::where('dictionary_id', $game->dictionary_id)->avg('percent_mistakes')
                ]);

                $profile = Profile::where('user_id', Auth::id())->first()->update([
                    'count_games' => Game::where('user_id', Auth::id())->count(),
                    'record_speed' => Game::where('user_id', Auth::id())->max('avg_speed'),
                    'avg_speed' => Game::where('user_id', Auth::id())->avg('avg_speed')
                ]);

//                $stats = Stats::where('dictionary_id', $game->dictionary_id)->first()->update([
//                    'avg_speed' => Game::where('dictionary_id', $game->dictionary_id)->avg('avg_speed'),
//                    'percent_mistakes' => Game::where('dictionary_id',)
//                ]);

                return response()->json([
                    'success' => 'success',
                    'message' => 'Данные сохранены!'
                ]);
            }
            else {
                return response()->json([
                    'errors' => 'error',
                    'message' => 'Пользователь не авторизован!'
                ], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
        $dictionary = Dictionary::with('user')
            ->where('id', $dictionary->id)
            ->first();

        return view('user.pages.training.training', [
            'dictionary' => $dictionary
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
