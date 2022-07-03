<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment','comment_name','comment_date','product_id','comment_status','rep_comment','created_at','updated_at'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'comment';

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
}
