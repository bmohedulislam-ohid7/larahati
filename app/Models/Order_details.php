<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;
     function relationtoproducttable(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
