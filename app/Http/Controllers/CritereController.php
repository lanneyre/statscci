<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCritereRequest;
use App\Http\Requests\UpdateCritereRequest;
use App\Models\Critere;
use App\Models\Formation;

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

        $criteres = Critere::all();
        return view("criteres.index", ["criteres" => $criteres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("criteres.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCritereRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCritereRequest $request)
    {
        $c = Critere::create($request->all());
        if ($c) {
            return redirect()->route('Critere.index')->with("success", "Critere créé avec succés");
        } else {
            return redirect()->route('Critere.index')->with("error", "Critere créé sans succés");
        }
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
    public function edit(int $critere)
    {
        $critere = Critere::find($critere);
        $formations = Formation::all();
        $formationsCritere = [];
        foreach ($critere->formations as $formation) {
            $formationsCritere[$formation->id] = $formation->pivot->valeur;
        }
        return view("criteres.edit", ["formationsCritere" => $formationsCritere, "formations" => $formations, "critere" => $critere]);
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
        $c = $critere->first();
        $formations = [];
        foreach ($request->formation as $formationId => $FormationValue) {
            # code...
            $formations[$formationId] = ["valeur" => $FormationValue];
        }
        $r = $c->update($request->all()) && $c->formations()->sync($formations);
        if ($r) {
            return redirect()->route('Critere.index')->with("success", "Critere modifié avec succés");
        } else {
            return redirect()->route('Critere.index')->with("error", "Critere modifié sans succé");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Critere $critere)
    {
        if ($critere->first()->delete()) {
            return redirect()->route('Critere.index')->with("success", "Critere supprimé avec succés");
        } else {
            return redirect()->route('Critere.index')->with("error", "Critere supprimé avec succés");
        }
    }
}
