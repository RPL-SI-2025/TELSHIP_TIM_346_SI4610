<?php
// app/Imports/MitraImport.php
namespace App\Imports;

use App\Models\Mitra;
use Maatwebsite\Excel\Concerns\ToModel;


class MitraImport implements ToModel
{
    public function model(array $row)
    {
        return new Mitra([
            'id_perusahaan'        => $row[1],
            'nama_perusahaan'      => $row[2],
            'deskripsi_perusahaan' => $row[3],
            'alamat'               => $row[4],
            'email'                => $row[5],
            'telepon'              => $row[6],
            'link_website'         => $row[7],
        ]);
    }
}