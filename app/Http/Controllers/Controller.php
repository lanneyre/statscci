<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Critere;
use App\Models\Formation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //
    function index(Request $request)
    {
        $allcriteres = Critere::all();
        if ($request->has('criteres')) {
            // $criteres = Critere::where('id', ">", 0)->orWhere($cr)->get();
            $criteres = Critere::whereIn('id', $request->criteres)->get();
            //$criteres->id;
        } else {
            $criteres = $allcriteres;
        }
        // dd($criteres);
        if ($request->has('filtres')) {
            if (in_array("Formations", $request->filtres)) {
                $formations = Formation::all();
            } else {
                $formations = null;
            }
            if (in_array("Centres", $request->filtres)) {
                $centres = Centre::all();
            } else {
                $centres = null;
            }
            if (in_array("Lieux", $request->filtres)) {
                $lieux = Centre::select('lieu')->distinct()->get();
            } else {
                $lieux = null;
            }
        } else {
            $formations = Formation::all();
            $centres = Centre::all();
            $lieux = Centre::select('lieu')->distinct()->get();
        }

        $ligne = 0;
        $arraySearch = [];
        $arraySearch[$ligne][] = null;
        foreach ($criteres as $critere) {
            $arraySearch[$ligne][] = $critere->nom;
        }
        $ligne++;
        if (!empty($formations)) {
            $arraySearch[$ligne]["titre"] = "Formations";
            $ligne++;
            $total = [];
            for ($i = 1; $i <= count($criteres); $i++) {
                $total[$i] = 0;
            }
            foreach ($formations as $formation) {
                $col = 0;
                $arraySearch[$ligne][$col] = $formation->nom;
                $col++;
                if (empty($request->criteres)) {
                    $c = $formation->criteres()->get();
                } else {
                    $c = $formation->criteres()->wherePivotIn("critere_id", $request->criteres)->get();
                }
                if (count($c) > 0) {
                    foreach ($c as $crit) {
                        $total[$col] += $crit->pivot->valeur;
                        $arraySearch[$ligne][$col] = $crit->pivot->valeur;
                        $col++;
                    }
                } else {
                    for ($i = 0; $i < count($criteres); $i++) {
                        $arraySearch[$ligne][$col] = 0;
                        $col++;
                    }
                }
                $ligne++;
            }
            $arraySearch[$ligne]["total"] = "Totaux";
            foreach ($total as $value) {
                $arraySearch[$ligne][] = $value;
            }
            $ligne++;
        }

        if (!empty($centres)) {
            $arraySearch[$ligne]["titre"] = "Centres";
            $ligne++;
            $total = [];
            for ($i = 1; $i <= count($criteres); $i++) {
                $total[$i] = 0;
            }
            foreach ($centres as $centre) {
                $col = 0;
                $arraySearch[$ligne][$col] = $centre->nom;
                $col++;
                foreach ($criteres as $critere) {
                    $arraySearch[$ligne][$col] = 0;
                    $formsAll = $critere->formations()->where("centre_id", $centre->id)->get();
                    foreach ($formsAll as $form) {
                        $arraySearch[$ligne][$col] += $form->pivot->valeur;
                        $total[$col] += $form->pivot->valeur;
                    }
                    $col++;
                }
                $ligne++;
            }
            $arraySearch[$ligne]["total"] = "Totaux";
            foreach ($total as $value) {
                $arraySearch[$ligne][] = $value;
            }
            $ligne++;
        }
        if (!empty($lieux)) {
            $arraySearch[$ligne]["titre"] = "Lieux";
            $ligne++;
            foreach ($lieux as $lieu) {
                $arraySearch[$ligne][] = $lieu->lieu;
                // foreach ($centre->criteres() as $crit) {
                //     $arraySearch[$ligne][] = $crit->pivot()->valeur;
                // }
                $ligne++;
            }
        }


        return view('welcome', ["allcriteres" => $allcriteres, "criteres" => $criteres, "formations" => $formations, "centres" => $centres, "lieux" => $lieux, "arraySearch" => $arraySearch]);
    }
}
