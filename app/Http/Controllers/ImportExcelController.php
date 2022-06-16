<?php

namespace App\Http\Controllers;

use App\Imports\PoleEmploiImport;
use App\Exports\ExcelExport;
use App\Models\Centre;
use App\Models\Critere;
use App\Models\Formation;
use Illuminate\Http\Request;
// use Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel as Excel;
// use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    private function formatExcel2DateTime(int $date, string $format = "Y-m-d")
    {
        return (\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date))->format($format);
    }

    function index()
    {
        return view('import_excel');
    }
    function import(Request $request)
    {
        $this->validate($request, [
            'select_file' => "required|mimes:xls,xlsx"
        ]);

        $path = $request->file("select_file")->getRealPath();
        $data = (new PoleEmploiImport)->toCollection($path, null, \Maatwebsite\Excel\Excel::XLSX);

        //On recupère les données dans des variables
        $numMarche = $data[0][4][2];
        $numConvention = $data[0][4][5];
        $centre = $data[0][8][2];
        $lieu = $data[0][10][5];

        //dd($data[0][10]);
        $nomForm = $data[0][6][2];
        $dd = $this->formatExcel2DateTime($data[0][10][1]);
        $df = $this->formatExcel2DateTime($data[0][10][3]);
        $continue = true;
        $start = 13;
        $criteres = [];
        do {
            if (!empty($data[0][$start][0]) && (!empty($data[0][$start][5]) || $data[0][$start][5] === 0)) {
                $criteres[$data[0][$start][0]] = $data[0][$start][5];
            }
            if (empty($data[0][$start + 1][0]) && empty($data[0][$start + 2][0])) {
                $continue = false;
            }
            $start++;
        } while ($continue);
        // echo '<pre>';
        // var_dump($df);
        // echo '</pre>';

        // on allimente la bdd en commençant par le centre
        $newCentre = Centre::firstOrCreate(["nom" => $centre, "lieu" => $lieu]);

        // Puis par la formation
        $newFormation = Formation::firstOrCreate([
            'nom' => $nomForm,
            'dd' => $dd,
            'df' => $df,
            'numMarche' => $numMarche,
            'numConvention' => $numConvention,
            'centre_id' => $newCentre->id
        ]);

        // On rajoute les critères
        $newFormation->criteres()->detach();
        $newFormation->save();
        foreach ($criteres as $critere => $value) {
            # code...
            $newCrit = Critere::firstOrCreate(["nom" => $critere]);
            $newFormation->criteres()->attach($newCrit, ["valeur" => $value]);
            $newFormation->save();
        }

        return Redirect::route("home")->withSuccess("Importation réussie");
    }

    function export()
    {
        return Excel::download(new ExcelExport, 'Template.xlsx');
        //return Excel::download(new ExcelExport($data[0]), 'Template.xlsx');
    }
}
