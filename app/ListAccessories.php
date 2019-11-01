<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListAccessories extends Model
{
    //
    protected $table = 'list_accessories';
    protected $fillable = [
        'accessories_group_id',
        'accessories_id'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
