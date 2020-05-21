<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class Customer extends BaseModel
{
    protected $table = "customers";
    protected $fillable = ['name', 'email', 'phone_number', 'address'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
}
