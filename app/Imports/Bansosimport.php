<?php

namespace App\Imports;

use App\Models\bansos;
use Maatwebsite\Excel\Concerns\ToModel;

class Bansosimport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new bansos([
            'nama_penerima' => $row[0],
            'jenis_bantuan' => $row[1],
            'alamat' => $row[2],
        ]);
    }
}
