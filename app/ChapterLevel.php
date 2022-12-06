<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterLevel extends Model
{
    use HasFactory;

    protected $table = 'chapter_levels';

    protected $fillable = [
        'title', 'icon', 'slug', 'status', 'chapter_id'
    ];

    // one to many
    public function chapter()
    {
        return $this->belongsTo(CourseChapter::class, 'chapter_id');
    }

    // one to many
    public function classes()
    {
        return $this->hasMany(CourseClass::class);
    }
}
