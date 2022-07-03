<?php

namespace App\Exports;

use App\Models\Size;
use Maatwebsite\Excel\Concerns\FromCollection;

class SizeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Size::all();
    }
}
