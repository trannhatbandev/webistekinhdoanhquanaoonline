<?php

namespace App\Imports;

use App\Models\TransportFee;
use Maatwebsite\Excel\Concerns\ToModel;

class TransportFeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TransportFee([
            'nametp'=>$row[0],
            'maqh'=>$row[1],
            'maxptt'=>$row[2],
            'transport_fee_freeship'=>$row[3],
        ]);
    }
}
