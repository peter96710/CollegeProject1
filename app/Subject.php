<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'teacher_id', 'desc','code','credit',
    ];

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->hasOne('App\User', 'id', 'teacher_id');
    }
}
