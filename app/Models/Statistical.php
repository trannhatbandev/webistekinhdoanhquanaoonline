<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_date','sales','profit','quantity','total_order','created_at','updated_at'
    ];
    protected $primaryKey = 'statistical_id';
    protected $table = 'statistical';
}
