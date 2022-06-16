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
        $centres = Centre::all();
        return view("centres.index", ["centres" => $centres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("centres.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCentreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCentreRequest $request)
    {
        $c = Centre::create($request->all());
        if ($c) {
            return redirect()->route('Centre.index')->with("success", "Centre créé avec succés");
        } else {
            return redirect()->route('Centre.index')->with("error", "Centre créé sans succés");
        }
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
        $centre = $centre->first();
        return view("centres.edit", ["centre" => $centre]);
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
        $c = $centre->first();
        $r = $c->update($request->all());
        if ($r) {
            return redirect()->route('Centre.index')->with("success", "Centre modifié avec succés");
        } else {
            return redirect()->route('Centre.index')->with("error", "Centre modifié sans succé");
        }
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
        if ($centre->first()->delete()) {
            return redirect()->route('Centre.index')->with("success", "Centre supprimé avec succés");
        } else {
            return redirect()->route('Centre.index')->with("error", "Centre supprimé avec succés");
        }
    }
}
