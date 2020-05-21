<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
class Order extends BaseModel
{
    protected $table = "orders";
    protected $fillable = ['qty', 'subtotal'];
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
