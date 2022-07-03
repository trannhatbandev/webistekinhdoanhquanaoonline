<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'permission_name'
    ];
    protected $primaryKey = 'permission_id';
    protected $table = 'permission';
}
