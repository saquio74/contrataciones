<?php

namespace App\Imports;

use App\contrato;
use Maatwebsite\Excel\Concerns\ToModel;

class contratoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new contrato([
            'proveedor_id'      => $row[0],
            'especialidad_id'   => $row[1],
            'contrato'          => $row[2],
            'fecha_inicio'      => '2020/01/01',
            'fecha_fin'         => '2020/12/31'
        ]);
    }
}
