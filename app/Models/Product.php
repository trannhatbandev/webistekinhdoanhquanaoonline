<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name','product_description','product_price','product_percent_discount','product_price_sale','product_price_cost','product_status','product_slug',
        'product_customer_views','product_date_sale_start','product_date_sale_end','product_image','category_id','brand_id','created_at','updated_at'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'product';

    public function layCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id','category_id');
    }
    public function layBrand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','brand_id');
    }
}
