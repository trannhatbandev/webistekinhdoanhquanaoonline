<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'category_name'=>$row[0],
            'category_slug'=>$row[1],
            'category_description'=>$row[2],
            'category_status'=>$row[3],
            'category_parent'=>$row[4],
        ]);
    }
}
