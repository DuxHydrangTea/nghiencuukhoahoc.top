<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    //
    protected $fillable = [
        'class_id',
        'subject_id',
        'description',
        'thumbnail',
        'icon',
        'color',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function class(){
        return $this->belongsTo(ClassModel::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function getNameAttribute(){
        return $this->subject()->title . ' - ' . $this->class()->title;
    }
}
