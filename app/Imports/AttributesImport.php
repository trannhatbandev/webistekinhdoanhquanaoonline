<?php

namespace App\Imports;

use App\Models\Attributes;
use Maatwebsite\Excel\Concerns\ToModel;

class AttributesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attributes([
            'product_id'=>$row[0],
            'size_id'=>$row[1],
            'color_id'=>$row[2],
            'quantity'=>$row[3],
        ]);
    }
}
