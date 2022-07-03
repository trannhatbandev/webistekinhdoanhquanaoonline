<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_customer_name','shipping_customer_address','shipping_customer_phone','customer_id',
        'matp','maqh','maxptt','shipping_default','created_at','updated_at'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'shipping';
}
