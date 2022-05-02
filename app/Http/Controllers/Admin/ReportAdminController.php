<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportAdminController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        if ($request->ajax())
        {
            if ($request->type == 'accept') {
                $report->update([
                    'status_code' => 'accept',
                    'status_text' => 'Принят',
                    'report' => null
                ]);

                $dictionary = Dictionary::where('id', $request->id)
                    ->with('report')
                    ->first();

                return response()->json([
                    'success' => 'success',
                    'message' => 'Словарь успешно принят!',
                    'view' => view('admin.pages.dictionaries.ajax.access-btn-sm', [
                        'dictionary' => $dictionary
                    ])->render()
                ]);
            }

            else if ($request->type == 'wait') {
                $report->update([
                    'status_code' => 'wait',
                    'status_text' => 'Проверяется'
                ]);

                $dictionary = Dictionary::where('id', $request->id)
                    ->with('report')
                    ->first();

                return response()->json([
                    'success' => 'success',
                    'message' => 'Вы можете изменить решение!',
                    'dictionary' => $dictionary,
                    'view' => view('admin.pages.dictionaries.ajax.access-btn-sm', [
                        'dictionary' => $dictionary
                    ])->render()
                ]);
            }

            else if ($request->type == 'deny') {
                $errors = Validator::make($request->all(), [
                    'report' => [
                        'required', 'string'
                    ],
                ]);

                if ($errors->fails()) {
                    return response()->json([
                        'errors' => $errors->errors(),
                        'message' => 'Указанные данные недействительны.'
                    ], 422);
                }

                $report->update([
                    'status_code' => 'deny',
                    'status_text' => 'Отказ',
                    'report' => $request->report
                ]);

                $dictionary = Dictionary::where('id', $request->id)
                    ->with('report')
                    ->first();

                return response()->json([
                    'success' => 'success',
                    'message' => 'Словарь успешно исключен!',
                    'view' => view('admin.pages.dictionaries.ajax.access-btn-sm', [
                        'dictionary' => $dictionary
                    ])->render()
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function getReport(Request $request, Report $report)
    {
        return response()->json([
            'report' => $report
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
