<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleUpdate extends Model
{
    protected $fillable = ['article_id', 'update_content'];

    public function article() {
        return $this->belongsTo(Article::class);
    }
}
