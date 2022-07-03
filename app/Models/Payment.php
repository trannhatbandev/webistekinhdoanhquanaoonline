<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id','payment_method','cart_payment','created_at','updated_at'
    ];
    protected $primaryKey = 'payment_id';
    protected $table = 'payment';
}
