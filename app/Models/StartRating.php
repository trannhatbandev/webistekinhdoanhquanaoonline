<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','rating','created_at','updated_at'
    ];
    protected $primaryKey = 'start_rating_id';
    protected $table = 'start_rating';
}
