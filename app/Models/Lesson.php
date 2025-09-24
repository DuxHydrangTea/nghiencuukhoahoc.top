<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $table = 'lessons';

    protected $fillable = [
        'chapter_id',
        'title',
        'description',
        'thumbnail',
        'icon',
        'tags',
        'video_url',
        'slide_url',
        'duration',
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function chapter (){
        return $this->belongsTo(Chapter::class);
    }
}
