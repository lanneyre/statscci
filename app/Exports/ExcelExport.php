<?php

namespace App\Exports;

use App\Models\Critere;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class ExcelExport implements FromView, WithStyles, WithColumnWidths, ShouldAutoSize
{
    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 16,
            'C' => 12,
            'D' => 12,
            'E' => 12,
            'F' => 12
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getRowDimension(1)->setRowHeight(-1);
        $sheet->getRowDimension(2)->setRowHeight(4);
        $sheet->getRowDimension(4)->setRowHeight(4);
        $sheet->getRowDimension(6)->setRowHeight(4);
        $sheet->getRowDimension(8)->setRowHeight(4);
        $sheet->getRowDimension(10)->setRowHeight(4);

        $sheet->setCellValue('B5', "SELECT ITEM");

        $configs = "DUS800, DUG900+3xRRUS, DUW2100, 2xMU, SIU, DUS800+3xRRUS, DUG900+3xRRUS, DUW2100";
        $objValidation = $sheet->getCell('B5')->getDataValidation();
        $objValidation->setType(DataValidation::TYPE_LIST);
        $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
        $objValidation->setAllowBlank(false);
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('Input error');
        $objValidation->setError('Value is not in list.');
        $objValidation->setPromptTitle('Pick from list');
        $objValidation->setPrompt('Please pick a value from the drop-down list.');
        $objValidation->setFormula1('"' . $configs . '"');

        return [
            1    => ['font' => ['bold' => true, "size" => "13pt"], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            3    => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            13    => [
                'font' => ['bold' => true, "size" => "9pt"],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ],
            12    => ['font' => ['bold' => true, "size" => "9pt", 'color' => ['rgb' => "800000"]], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'A3' => ['font' => ['italic' => true, 'underline' => true]],
            'A5' => ['font' => ['bold' => true, "size" => "8pt"]],
            'A7' => ['font' => ['bold' => true, "size" => "8pt"]],
            'A9' => ['font' => ['bold' => true, "size" => "8pt"]],
            'A11' => ['font' => ['bold' => true, "size" => "8pt"]],
            'C11' => ['font' => ['bold' => true, "size" => "8pt"]],
            'D5' => ['font' => ['bold' => true, "size" => "8pt"]],
            'E11' => ['font' => ['bold' => true, "size" => "8pt"]],
            'A13:F13' => ['fill' => ['fillType' => 'solid', 'color' => ['rgb' => "99ccff"]]],
            'A14:F50' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'C5' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'C9' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'B11' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'D11' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'F11' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'C7' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'F5' => ['font' => ["size" => "8pt"], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => "D9D9D9"]]],
            'A13:F50' => ['borders' => ["allBorders" => ['borderStyle' => Border::BORDER_THIN]]],
        ];
    }
    public function view(): View
    {
        return view('export_excel', [
            'criteres' => Critere::all()
        ]);
    }
}
