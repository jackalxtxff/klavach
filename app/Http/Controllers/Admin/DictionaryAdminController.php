<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.dictionaries.dictionaries');
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
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Dictionary $dictionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dictionary $dictionary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dictionary $dictionary)
    {
        //
    }
}
