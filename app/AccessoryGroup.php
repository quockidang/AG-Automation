<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessoryGroup extends Model
{
    //
    protected $table = 'accessory_group';
    protected $fillable = [
        'name',
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
