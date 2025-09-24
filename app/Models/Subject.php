<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table = 'subjects';

    protected $fillable = [
        'class_id',
        'title',
        'description',
        'thumbnail',
        'icon',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_subjects', 'subject_id', 'class_id');
    }
}
