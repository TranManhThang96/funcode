<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content',
        'image',
        'status',
        'type',
        'link_references',
        'created_by',
        'updated_by'
    ];
}
