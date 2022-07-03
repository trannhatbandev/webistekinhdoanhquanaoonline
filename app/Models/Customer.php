<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_full_name','customer_password','customer_email','customer_phone','customer_address','customer_vip','customer_token','created_at','updated_at'
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'customer';
}
