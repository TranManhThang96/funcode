<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesViewLog extends Model
{
    use HasFactory;
    protected $table = 'articles_view_log';

    protected $fillable = [
        'article_id',
        'article_slug',
        'ip_address',
        'user_agent',
        'platform',
        'browser',
        'isPhone',
        'device',
    ];
}
