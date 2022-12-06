<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'instructors';

    protected $fillable = [
        'user_id', 'fname', 'lname', 'email', 'dob', 'mobile', 'gender', 'detail', 'file', 'image', 'status',
        'comment', 'disabled', 'Reason_for_joining', 'type', 'interview_date',
    ];

    public function courses()
    {
        return $this->hasMany('App\Course', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault();
    }
}
