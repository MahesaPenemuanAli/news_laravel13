<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleUpdate extends Model
{
    protected $fillable = ["article_id", "update_content"];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
