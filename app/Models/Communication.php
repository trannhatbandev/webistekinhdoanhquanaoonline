<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;
    protected $fillable = [
        'communications_contact','communications_map','communications_image','created_at','updated_at'
    ];
    protected $primaryKey = 'communications_id';
    protected $table = 'communications';
}
