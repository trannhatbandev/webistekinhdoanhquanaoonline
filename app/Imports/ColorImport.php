<?php

namespace App\Imports;

use App\Models\Color;
use Maatwebsite\Excel\Concerns\ToModel;

class ColorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Color([
            'color_name'=>$row[0],
            'color_code'=>$row[1],
            'color_slug'=>$row[2],
            'color_status'=>$row[3],
        ]);
    }
}
