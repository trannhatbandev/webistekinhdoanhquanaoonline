<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'size_name','size_slug','size_description','size_status','created_at','updated_at'
    ];
    protected $primaryKey = 'size_id';
    protected $table = 'size';
}
