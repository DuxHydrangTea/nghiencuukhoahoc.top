<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    //
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'icon',
        'slogan',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'class_id', 'subject_id');
    }

}
