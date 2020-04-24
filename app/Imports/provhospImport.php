<?php

namespace App\Imports;

use App\provhosp;
use Maatwebsite\Excel\Concerns\ToModel;

class provhospImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new provhosp([
            'hospital_id'   => $row[0],
            'proveedor_id'  => $row[1]
        ]);
    }
}
