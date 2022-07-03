<?php

namespace App\Exports;

use App\Models\Attributes;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttributesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attributes::all();
    }
}
