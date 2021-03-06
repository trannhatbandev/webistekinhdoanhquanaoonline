<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name','category_slug','category_description','category_status','category_parent','created_at','updated_at'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'category';
}
