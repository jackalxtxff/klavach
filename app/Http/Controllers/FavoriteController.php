<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Favorite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($request->ajax())
        {
            if (!Auth::check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Для добавления словаря необходимо авторизироваться!'
                ], 422);
            }

            $data = new Favorite();

            $data->user_id = Auth::id();
            $data->dictionary_id = $request->id;

            try {
                $data->save();
            } catch (Exception $e) {
                return response()->json([
                   'error' => 'error',
                   'message' => 'Вы уже добавили этот словарь. Обновите страницу!'
                ], 402);
            }

            $dictionary = Dictionary::where('id', $request->id)
                ->with(['favorites' => function ($query) {
                    return $query->where('user_id', Auth::id());
                }])
                ->first();

            if ($request->type == 'btn-sm') {
                return response()->json([
                    'success' => 'success',
                    'message' => 'Словарь успешно добавлен!',
                    'view' => view('user.pages.dictionaries.ajax.favorite-btn-sm', [
                        'dictionary' => $dictionary
                    ])->render()
                ]);
            }
            else {
                return response()->json([
                    'success' => 'success',
                    'message' => 'Словарь успешно добавлен!',
                    'view' => view('user.pages.dictionaries.ajax.favorite-btn-lg', [
                        'dictionary' => $dictionary
                    ])->render()
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite, Request $request)
    {
        if ($favorite->delete()) {
            $dictionary = Dictionary::where('id', $favorite->dictionary_id)
                ->with(['favorites' => function ($query) {
                    return $query->where('user_id', Auth::id());
                }])
                ->first();
            if ($request->type == 'btn-sm') {
                return response()->json([
                    'success' => 'success',
                    'message' => 'Словарь удален из избранных!',
                    'view' => view('user.pages.dictionaries.ajax.favorite-btn-sm', [
                        'dictionary' => $dictionary
                    ])->render()
                ]);
            }
            else {
                return response()->json([
                    'success' => 'success',
                    'message' => 'Словарь удален из избранных!',
                    'view' => view('user.pages.dictionaries.ajax.favorite-btn-lg', [
                        'dictionary' => $dictionary
                    ])->render()
                ]);
            }
        }
        else {
            return response()->json([
                'error' => 'error',
                'message' => 'Ошибка при удалении словаря'
            ], 404);
        }
    }
}
