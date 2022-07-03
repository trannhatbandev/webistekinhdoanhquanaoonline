<?php

namespace App\Exports;

use App\Models\Discount_Code;
use Maatwebsite\Excel\Concerns\FromCollection;

class DiscountCodeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Discount_Code::all();
    }
}
