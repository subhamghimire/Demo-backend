<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
