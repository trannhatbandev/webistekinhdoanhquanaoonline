<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class momo extends Model
{
    use HasFactory;
    protected $fillable = [
        'partnerCode','orderId','amount','orderInfo','transId','message','payType','created_at','updated_at'
    ];
    protected $primaryKey = 'momo_id';
    protected $table = 'momo';
}
