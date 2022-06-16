<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Formation;
use App\Models\Centre;

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
        Formation::create($request->all());
        return redirect()->route('Formation.index')->with("success", "Formation créé avec succés");
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
    public function edit(Formation $formation)
    {
        //
        $centres = Centre::all();
        $formation = $formation->first();
        return view("formations.edit", ["formation" => $formation, "centres" => $centres]);
        //return view("formations.edit", ["formation" => $formation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormationRequest  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        //
        $f = $formation->first();
        $r = $f->update($request->all());
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
