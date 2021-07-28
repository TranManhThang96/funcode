<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tags';

    protected $fillable = [
        'label',
        'slug',
        'created_by',
        'updated_by'
    ];

    public function articles()
    {
        return $this->belongsToMany(\App\Models\Article::class, 'article_tag', 'tag_id' ,'article_id');
    }
}
