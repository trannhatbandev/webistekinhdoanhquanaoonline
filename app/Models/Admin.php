<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_full_name','admin_email','admin_phone','admin_address','admin_token','created_at','updated_at'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'admin';
}
