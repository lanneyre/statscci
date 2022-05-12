<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCentreRequest;
use App\Http\Requests\UpdateCentreRequest;
use App\Models\Centre;

class CentreController extends Controller
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
     * @param  \App\Http\Requests\StoreCentreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCentreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function show(Centre $centre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function edit(Centre $centre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCentreRequest  $request
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCentreRequest $request, Centre $centre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centre $centre)
    {
        //
    }
}
