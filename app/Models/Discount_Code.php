<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount_Code extends Model
{
    use HasFactory;
    protected $fillable = [
        'discount_code_name','discount_code_code','discount_code_quantity','discount_code_condition',
        'discount_code_price','discount_code_date_start','discount_code_date_end','created_at','updated_at'
    ];
    protected $primaryKey = 'discount_code_id';
    protected $table = 'discount_code';
}
