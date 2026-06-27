<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    public $timestamps = false;

    protected $fillable = ['article_id', 'ip_address', 'user_agent', 'viewed_date'];

    protected $casts = ['viewed_date' => 'date'];

    public function article() {
        return $this->belongsTo(Article::class);
    }
}
