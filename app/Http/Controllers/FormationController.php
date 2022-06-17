<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Formation;
use App\Models\Centre;
use App\Models\Critere;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $formations = Formation::all();
        return view("formations.index", ["formations" => $formations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $centres = Centre::all();
        return view("formations.create", ["centres" => $centres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFormationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormationRequest $request)
    {
        //
        // dd($request->all());
        $f = Formation::create($request->all());
        return redirect()->route('Formation.edit', $f)->with("success", "Formation créé avec succés");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit(int $formation)
    {
        //
        $centres = Centre::all();
        //dd($formation);
        $formation = Formation::find($formation);
        $criteres = Critere::all();
        $criteresFormation = [];
        //dump($formation);
        foreach ($formation->criteres as $critere) {
            $criteresFormation[$critere->id] = $critere->pivot->valeur;
        }
        return view("formations.edit", ["criteresFormation" => $criteresFormation, "criteres" => $criteres, "formation" => $formation, "centres" => $centres]);
        //return view("formations.edit", ["formation" => $formation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormationRequest  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormationRequest $request, int $formation)
    {
        //
        $f = Formation::find($formation);
        //$r = $f->update($request->all());
        //dd($request->all());
        $criteres = [];
        foreach ($request->critere as $critereId => $critereValue) {
            $criteres[$critereId] = ["valeur" => $critereValue];
        }
        $r = $f->update($request->all()) && $f->criteres()->sync($criteres);
        if ($r) {
            return redirect()->route('Formation.index')->with("success", "Formation modifiée avec succés");
        } else {
            return redirect()->route('Formation.index')->with("error", "Formation modifiée sans succé");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        //
        $formation->first()->delete();
        return redirect()->route('Formation.index')->with("success", "Formation supprimée avec succés");
    }
}
