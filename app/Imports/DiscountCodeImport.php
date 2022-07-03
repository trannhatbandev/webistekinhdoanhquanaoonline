<?php

namespace App\Imports;

use App\Models\Discount_Code;
use Maatwebsite\Excel\Concerns\ToModel;

class DiscountCodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Discount_Code([
            'discount_code_name'=>$row[0],
            'discount_code_code'=>$row[1],
            'discount_code_quantity'=>$row[2],
            'discount_code_condition'=>$row[3],
            'discount_code_price'=>$row[4],
        ]);
    }
}
