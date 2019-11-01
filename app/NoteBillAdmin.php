<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteBillAdmin extends Model
{
    //
    protected $table = 'note_bill_admin';
    protected $fillable = [
        'bill_admin_id',
        'content',
        'created_by'
    ];
    protected $primaryKey = 'id';
    public $timestamps = true;
}
