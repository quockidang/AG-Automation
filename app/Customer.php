<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $table = "customer1" ;
    protected $fillable = ['id','name','address','gender','email','phone'];

    function Bills(){
        return $this->hasOne('App\Bills','customer_id','id');
    }

}
