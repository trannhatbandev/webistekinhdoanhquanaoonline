<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportFee extends Model
{
    use HasFactory;
    protected $fillable = [
        'nametp','maqh','maxptt','transport_fee_freeship','created_at','updated_at'
    ];
    protected $primaryKey = 'transport_fee_id';
    protected $table = 'transport_fee';

    public function city(){
        return $this->belongsTo('App\Models\City','matp');
    }
    public function district(){
        return $this->belongsTo('App\Models\District','maqh');
    }
    public function ward(){
        return $this->belongsTo('App\Models\Ward','maxptt');
    }
}
