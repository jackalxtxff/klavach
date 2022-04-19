<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dictionary;
use Carbon\Carbon;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            $errors = Validator::make($request->all(), [
                'comment' => [
                    'required', 'string', 'max:200'
                ]
            ]);

            if ($errors->fails()) {
                return response()->json([
                    'errors' => $errors->errors(),
                    'message' => 'Указанные данные недействительны.'
                ], 422);
            }

            $comment = Comment::create([
                'user_id' => Auth::id(),
                'dictionary_id' => $request->dictionary_id,
                'comment' => $request->comment
            ]);

            $dictionary = Dictionary::where('id', $request->dictionary_id)
                ->with(['comments' => function ($query) {
                    return $query->orderBy('created_at', 'DESC')
                        ->limit(10);
                }])
                ->first();

            return response()->json([
                'success' => 'success',
                'message' => 'Комментарий отправлен!',
                'view' => view('user.pages.dictionaries.show.components.comments', [
                    'dictionary' => $dictionary
                ])->render()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $user = Auth::user();
        if (!$user->can('update', $comment)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Недостаточно прав!'
            ], 422);
        }

        if ($request->ajax())
        {
            $errors = Validator::make($request->all(), [
                'comment' => [
                    'required', 'string', 'max:200'
                ]
            ]);

            if ($errors->fails()) {
                return response()->json([
                    'errors' => $errors->errors(),
                    'message' => 'Указанные данные недействительны.'
                ], 422);
            }

            $comment->update([
                'comment' => $request->comment
            ]);

            $dictionary = Dictionary::where('id', $request->dictionary_id)
                ->with(['comments' => function ($query) {
                    return $query->orderBy('created_at', 'DESC')
                        ->limit(10);
                }])
                ->first();

            return response()->json([
                'success' => 'success',
                'message' => 'Комментарий изменен!',
                'view' => view('user.pages.dictionaries.show.components.comments', [
                    'dictionary' => $dictionary
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        $user = Auth::user();
        if (!$user->can('delete', $comment)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Недостаточно прав!'
            ], 422);
        }

        if ($comment->delete()) {

            $dictionary = Dictionary::where('id', $request->dictionary_id)
                ->with(['comments' => function ($query) {
                    return $query->orderBy('created_at', 'DESC')
                        ->limit(10);
                }])
                ->first();

            return response()->json([
                'success' => 'success',
                'message' => 'Комментарий успешно удален!',
                'view' => view('user.pages.dictionaries.show.components.comments', [
                    'dictionary' => $dictionary
                ])->render()
            ]);
        }
        else $message = 'Ошибка при удалении комментария';

        return response()->json([
            'error' => 'error',
            'message' => $message
        ], 404);
    }
}
