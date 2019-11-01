<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetailAdmin extends Model
{
    //
    public $timestamps = false;

    protected $table = "bill_detail_admin" ;
    protected $fillable = ['id','bill_id','product_id','quantity','price'];
}
