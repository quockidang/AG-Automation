<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bills extends Model
{
    public $timestamps = true;

    protected $table = "bills1" ;
    protected $fillable = ['id', 'customer_id','total','status'];

    public function Customer(){
        return $this->belongsTo('App\Customer','customer_id','id');
    }

    // function BillDetail(){
    //     return $this->hasMany('App\BillDetail','MaLop','MaLop');
    // }
}
