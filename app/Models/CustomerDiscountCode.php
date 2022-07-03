<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDiscountCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','discount_code_id','created_at','updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'customer_discount_code';
}
