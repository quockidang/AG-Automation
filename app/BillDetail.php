<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDetail extends Model
{
    public $timestamps = false;
  
    protected $table = "bill_detail" ;
    protected $dates = ['deleted_at'];
     protected $fillable = ['id','bill_id','product_id','quantity','price'];
    public function Bills(){
        return $this->belongsTo('App\Bills','bill_id','id');
    }

    public function Product()
    {
        return $this->belongsTo('App\Product', 'product_id','id');
    }


}
