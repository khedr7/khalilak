<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementTestReport extends Model
{
    use HasFactory;

    protected $table = 'placement_test_reports';

    protected $fillable = [
        'user_id', 'quiz_topic_id', 'general_mark', 'reading_mark',
        'listening_mark', 'speaking_mark', 'final_mark',
    ];

    // one to many
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // one to many
    public function quiz()
    {
        return $this->belongsTo(QuizTopic::class, 'quiz_topic_id');
    }
}
