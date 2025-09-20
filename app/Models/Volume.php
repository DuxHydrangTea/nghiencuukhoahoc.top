<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    protected $fillable = [
        'subject_id',
        'title',
        'description',
        'thumbnail',
        'icon',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
