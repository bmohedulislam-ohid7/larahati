<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    //  protected $fillable = ['category_name'];
    protected $fillable = ['product_name','product_price','product_quantity','product_short_discription', 'product_long_discription','product_alert_quantity','product_photo'];

}
