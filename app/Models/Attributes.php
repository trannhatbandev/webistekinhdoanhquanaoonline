<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','size_id','color_id','quantity','created_at','updated_at'
    ];
    protected $primaryKey = 'attributes_id';
    protected $table = 'attributes';

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
    public function size(){
        return $this->belongsTo('App\Models\Size','size_id','size_id');
    }
    public function color(){
        return $this->belongsTo('App\Models\Color','color_id','color_id');
    }
}
