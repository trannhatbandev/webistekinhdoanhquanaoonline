<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Has_Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id','permission_id'
    ];
    protected $primaryKey = 'role_has_permission_id';
    protected $table = 'role_has_permission';
}
