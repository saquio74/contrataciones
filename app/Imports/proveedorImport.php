<?php

namespace App\Imports;

use App\proveedor;
use Maatwebsite\Excel\Concerns\ToModel;

class proveedorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new proveedor([
            'proveedor' => $row[0],
            'dni'       => $row[1],
            'cuil'      => $row[2],
            'nombre'    => $row[3],
            'apellido'  => $row[4],
            'genero'    => $row[5],
        ]);
    }
}
