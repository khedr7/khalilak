<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindJob extends Model
{
    use HasFactory;

    protected $table = 'find_jobs';

    protected $fillable = [
        'title', 'cv', 'status', 'user_id'
    ];

    // one to many
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
