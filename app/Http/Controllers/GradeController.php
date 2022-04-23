<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Game;
use App\Models\Grade;
use App\Models\Stats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
            $games = Game::where('user_id', Auth::id())
                ->where('dictionary_id', $request->dictionary)
                ->get();

            if (count($games) < 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Для оценки словаря вы должны хотя бы раз потренироваться на нем!',
                    'games' => $games
                ], 401);
            }

            $data = new Grade();

            $data->user_id = Auth::id();
            $data->dictionary_id = $request->dictionary;
            $data->grade = $request->grade;

            $data->save();

            $stats = Stats::where('dictionary_id', $request->dictionary)->first();
            if($stats) {
                $stats->avg_grade = Grade::where('dictionary_id', $request->dictionary)->avg('grade');
                $stats->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Вы поставили оценку!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        if ($request->ajax()) {

            $grade->grade = $request->grade;
            $grade->save();

            $stats = Stats::where('dictionary_id', $request->dictionary)->first();
            if($stats) {
                $stats->avg_grade = Grade::where('dictionary_id', $request->dictionary)->avg('grade');
                $stats->save();
            }

            return response()->json([
                'success' => 'success',
                'message' => 'Вы изменили оценку!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
