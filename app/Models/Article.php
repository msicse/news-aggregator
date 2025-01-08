<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'description', 'content', 'url', 'image', 'author', 'source', 'category', 'published_at'
    ];
}
