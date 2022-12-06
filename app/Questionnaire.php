<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{    
    use HasFactory;
 
    protected $fillable = ['user_id', 'course_id', 'question', 'type', 'answer'];

    // one to many
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // one to many
    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }
}
