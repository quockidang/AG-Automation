<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = "categories" ;
    protected $fillable = ['id','id_url','categories_name','icon'];
    public $timestamps = false;
    public function Product()
    {
        return $this->hasMany("App\Product", 'id_type', 'id')->where('deleted',0);
    }


}
