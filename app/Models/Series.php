<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'series';

    protected $fillable = [
        'name',
        'slug',
        'created_by',
        'updated_by',
    ];

    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class, 'series_id', 'id');
    }
}
