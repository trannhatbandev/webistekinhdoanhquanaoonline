<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipping_id','order_code','payment_id','order_status','created_at','updated_at'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'order';

    public function shipping(){
        return $this->belongsTo('App\Models\Shipping','shipping_id','shipping_id');
    }
    public function payment(){
        return $this->belongsTo('App\Models\Payment','payment_id','payment_id');
    }
}
