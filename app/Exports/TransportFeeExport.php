<?php

namespace App\Exports;

use App\Models\TransportFee;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransportFeeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransportFee::all();
    }
}
