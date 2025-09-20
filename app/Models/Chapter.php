<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //

    protected $table = 'chapters';

    protected $fillable = [
        'volume_id',
        'title',
        'description',
        'thumbnail',
        'icon',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array'
    ];
}
