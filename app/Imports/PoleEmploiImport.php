<?php

namespace App\Imports;

use App\Models\tableauPE;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PoleEmploiImport implements ToModel, WithCalculatedFormulas
{

    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new tableauPE($row);
    }
}
