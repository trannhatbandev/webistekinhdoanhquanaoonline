<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_title','blog_slug','blog_description','blog_content','blog_image','blog_status','created_at','updated_at'
    ];
    protected $primaryKey = 'blog_id';
    protected $table = 'blog';
}
