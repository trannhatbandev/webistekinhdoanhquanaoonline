<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_user','provider','user_id','created_at','updated_at'
    ];
    protected $primaryKey = 'social_id';
    protected $table = 'social';

    public function login(){
        return $this->belongsTo(Customer::class,'user_id');
    }
}
