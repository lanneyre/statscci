<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCritereRequest;
use App\Http\Requests\UpdateCritereRequest;
use App\Models\Critere;

class CritereController extends Controller
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
     * @param  \App\Http\Requests\StoreCritereRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCritereRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function show(Critere $critere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function edit(Critere $critere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCritereRequest  $request
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCritereRequest $request, Critere $critere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Critere $critere)
    {
        //
    }
}
