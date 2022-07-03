<?php

namespace App\Imports;

use App\Models\Size;
use Maatwebsite\Excel\Concerns\ToModel;

class SizeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Size([
            'size_name'=>$row[0],
            'size_slug'=>$row[1],
            'size_description'=>$row[2],
            'size_status'=>$row[3],
        ]);
    }
}
