<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class Product extends BaseModel
{
    protected $table = "products";
    protected $fillable = ['name', 'slug', 'price', 'image'];

    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
