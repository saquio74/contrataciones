<?php

namespace App\Imports;

use App\especialidad;
use Maatwebsite\Excel\Concerns\ToModel;

class especialidadImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new especialidad([
            'grado' => $row[0],
            'nombre'=> $row[1],
        ]);
    }
}
