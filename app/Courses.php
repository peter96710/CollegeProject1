<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject_id', 'student_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function subject()
    {
        return $this->hasOne('App\Subject', 'id', 'subject_id');
    }

}
