<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['id','id_url','id_type','name','detail','detail_descrip','price','image',
                            'deleted', 'sub_product', 'isdefault', 'accessory_group_id'];
    // public function Customization()
    // {
    //     return $this->hasMany('App\Customization', 'product_id', 'id');
    // }



    public function ProductType()
    {
        return $this->belongsTo('App\ProductType', 'id_type','id');
    }



}
