<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'gallery_name','gallery_image','product_id','created_at','updated_at'
    ];
    protected $primaryKey = 'gallery_id';
    protected $table = 'gallery';
}
