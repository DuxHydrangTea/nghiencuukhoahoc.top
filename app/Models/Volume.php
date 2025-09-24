<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    protected $fillable = [
        'class_subject_id',
        'title',
        'description',
        'thumbnail',
        'icon',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function classSubject(){
        return $this->belongsTo(ClassSubject::class);
    }
}
