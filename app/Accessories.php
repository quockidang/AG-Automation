<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    //
    protected $table = 'accessories';
    protected $fillable = [
        'name',
        'price',
        'meta_desc',
        'code',
        'image',
        'is_obligatory',
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
