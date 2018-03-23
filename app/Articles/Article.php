<?php

namespace App\Articles;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
        'author',
        'published',
    ];
}
