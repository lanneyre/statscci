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
    function indexPost(Request $request)
    {
        if ($request->has('datedd') && $request->has('datedf') && $request->datedf > $request->datedd) {
            $dates = true;
        } else {
            $dates = false;
        }
        $allcriteres = Critere::all();
        if ($request->has('criteres')) {
            // $criteres = Critere::where('id', ">", 0)->orWhere($cr)->get();
            $criteres = Critere::whereIn('id', $request->criteres)->get();
            //$criteres->id;
        } else {
            $criteres = $allcriteres;
        }
        // dd($criteres);
        $distinctFormations = Formation::select("nom")->distinct()->get();
        if ($request->has('filtres')) {
            if (in_array("Formations", $request->filtres)) {
                if ($dates) {
                    $formations = Formation::where('dd', ">", $request->datedf)->Where('df', "<", $request->datedd)->get();
                } else {
                    $formations = Formation::all();
                }
                // if ($request->has('distinctFormations')) {
                //     $FormationSeleted = Formation::WhereIn("nom", $request->distinctFormations)->get();
                //     //dd($distinctFormations);
                // } else {
                //     $FormationSeleted = null;
                // }
            } else {
                $formations = null;
            }
            if (in_array("Centres", $request->filtres)) {
                $centres = Centre::all();
            } else {
                $centres = null;
            }
            // if (in_array("Lieux", $request->filtres)) {
            //     $lieux = Centre::select('lieu')->distinct()->get();
            // } else {
            //     $lieux = null;
            // }
        } else {
            $formations = Formation::all();
            $centres = Centre::all();
            //$lieux = Centre::select('lieu')->distinct()->get();
        }

        $ligne = 0;
        $arraySearch = [];
        $arraySearch[$ligne][] = null;
        foreach ($criteres as $critere) {
            $arraySearch[$ligne][] = $critere->nom;
        }
        $ligne++;
        if (!empty($formations)) {
            if (empty($distinctFormations) || empty($request->filtresFormations)) {
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
            } else {
                $arraySearch[$ligne]["titre"] = "Formations regroupées";
                $ligne++;
                $total = [];
                for ($i = 1; $i <= count($criteres); $i++) {
                    $total[$i] = 0;
                }

                //dd($distinctFormations);
                foreach ($request->distinctFormations as $df) {
                    $formationsByNom = Formation::Where("nom", $df)->get();
                    $col = 0;
                    //dump($formationsByNom);
                    $arraySearch[$ligne][$col] = $formationsByNom[0]->nom;
                    $col++;
                    // ligne première formation :
                    foreach ($formationsByNom as $formationByNom) {
                        if (empty($request->criteres)) {
                            $c = $formationByNom->criteres()->get();
                        } else {
                            $c = $formationByNom->criteres()->wherePivotIn("critere_id", $request->criteres)->get();
                        }
                        if (count($c) > 0) {
                            foreach ($c as $crit) {
                                $total[$col] += $crit->pivot->valeur;
                                if (empty($arraySearch[$ligne][$col])) {
                                    $arraySearch[$ligne][$col] = $crit->pivot->valeur;
                                } else {
                                    $arraySearch[$ligne][$col] += $crit->pivot->valeur;
                                }
                                $col++;
                            }
                        } else {
                            for ($i = 0; $i < count($criteres); $i++) {
                                $arraySearch[$ligne][$col] = 0;
                                $col++;
                            }
                        }
                        $col = 1;
                        //dump($c);
                    }
                    $ligne++;
                }
                // foreach ($FormationSeleted as $formation) {
                //     $col = 0;
                //     $arraySearch[$ligne][$col] = $formation->nom;
                //     $col++;
                //     if (empty($request->criteres)) {
                //         $c = $formation->criteres()->get();
                //     } else {
                //         $c = $formation->criteres()->wherePivotIn("critere_id", $request->criteres)->get();
                //     }
                //     if (count($c) > 0) {
                //         foreach ($c as $crit) {
                //             $total[$col] += $crit->pivot->valeur;
                //             $arraySearch[$ligne][$col] = $crit->pivot->valeur;
                //             $col++;
                //         }
                //     } else {
                //         for ($i = 0; $i < count($criteres); $i++) {
                //             $arraySearch[$ligne][$col] = 0;
                //             $col++;
                //         }
                //     }
                //     $ligne++;
                // }



                $arraySearch[$ligne]["total"] = "Totaux";
                foreach ($total as $value) {
                    $arraySearch[$ligne][] = $value;
                }
                $ligne++;
            }
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
        // if (!empty($lieux)) {
        //     $arraySearch[$ligne]["titre"] = "Lieux";
        //     $ligne++;
        //     $total = [];
        //     for ($i = 1; $i <= count($lieux); $i++) {
        //         $total[$i] = 0;
        //     }
        //     foreach ($lieux as $lieu) {
        //         $col = 0;
        //         $arraySearch[$ligne][$col] = $lieu->lieu;
        //         $col++;

        //         $centreAll = Centre::where("lieu", $lieu->lieu)->get();

        //         foreach ($centreAll as $cent) {
        //             $formsAll = $cent->formations()->get();
        //             foreach ($formsAll as $form) {
        //                 if ($request->has('criteres')) {
        //                     $crits = $form->criteres()->whereIn('id', $request->criteres)->get();
        //                 } else {
        //                     $crits = $form->criteres()->get();
        //                 }
        //                 foreach ($crits as $crit) {
        //                     //if ($col > 0) {
        //                     if (empty($arraySearch[$ligne][$col])) {
        //                         $arraySearch[$ligne][$col] = 0;
        //                     }
        //                     if (empty($total[$col])) {
        //                         $total[$col] = 0;
        //                     }
        //                     //var_dump($ligne, $col, $arraySearch[$ligne][$col], $crit->pivot->valeur,  "<br>");

        //                     $arraySearch[$ligne][$col] += $crit->pivot->valeur;
        //                     $total[$col] += $crit->pivot->valeur;
        //                     // }
        //                     $col++;
        //                 }
        //                 $col -= count($crits);
        //             }
        //         }
        //         $col++;
        //         $ligne++;
        //     }
        //     $arraySearch[$ligne]["total"] = "Totaux";
        //     foreach ($total as $value) {
        //         $arraySearch[$ligne][] = $value;
        //     }
        //     $ligne++;
        // }


        return view('welcome', ["distinctFormations" => $distinctFormations, "allcriteres" => $allcriteres, "criteres" => $criteres, "formations" => $formations, "centres" => $centres, "lieux" => $lieux, "arraySearch" => $arraySearch]);
    }

    function index()
    {
        $allcriteres = Critere::all();
        $criteres = $allcriteres;
        // dd($criteres);
        $formations = Formation::all();
        $centres = Centre::all();
        $lieux = Centre::select('lieu')->distinct()->get();
        $distinctFormations = Formation::select("nom")->distinct()->get();
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
                $c = $formation->criteres()->get();
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
            $total = [];
            for ($i = 1; $i <= count($lieux); $i++) {
                $total[$i] = 0;
            }
            foreach ($lieux as $lieu) {
                $col = 0;
                $arraySearch[$ligne][$col] = $lieu->lieu;
                $col++;

                $centreAll = Centre::where("lieu", $lieu->lieu)->get();
                foreach ($centreAll as $cent) {
                    $formsAll = $cent->formations()->get();
                    foreach ($formsAll as $form) {

                        $crits = $form->criteres()->orderBy("critere_id")->get();
                        foreach ($crits as $crit) {
                            //if ($col > 0) {
                            if (empty($arraySearch[$ligne][$col])) {
                                $arraySearch[$ligne][$col] = 0;
                            }
                            if (empty($total[$col])) {
                                $total[$col] = 0;
                            }
                            //if ($col > 0) {
                            //var_dump($ligne, $col, $arraySearch[$ligne][$col], $crit->pivot->valeur,  "<br>");
                            //dump($crit);

                            $arraySearch[$ligne][$col] += $crit->pivot->valeur;
                            $total[$col] += $crit->pivot->valeur;
                            //dump($crit->pivot->valeur . "-> " . $arraySearch[$ligne][$col]);
                            $col++;
                        }
                        $col -= count($crits);
                    }
                }
                $col++;
                $ligne++;
            }
            $arraySearch[$ligne]["total"] = "Totaux";
            foreach ($total as $value) {
                $arraySearch[$ligne][] = $value;
            }
            $ligne++;
        }


        return view('welcome', ["distinctFormations" => $distinctFormations, "allcriteres" => $allcriteres, "criteres" => $criteres, "formations" => $formations, "centres" => $centres, "lieux" => $lieux, "arraySearch" => $arraySearch]);
    }
}
