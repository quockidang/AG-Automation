<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillAdmin extends Model
{
    public $timestamps = true;
  
    protected $table = "bill_admin" ;
    protected $fillable = ['id','customer_id','total','created_at','created_by'];

}
