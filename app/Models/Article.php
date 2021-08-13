<?php

namespace App\Models;

use App\Enums\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;

class Article extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $appends = ['status_label', 'type_label'];
    protected $table = 'articles';

    protected $casts = [
        'link_references' => 'array',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'series_id',
        'series_order',
        'excerpt',
        'content',
        'image',
        'status',
        'type',
        'link_references',
        'created_by',
        'updated_by'
    ];

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'article_tag', 'article_id' ,'tag_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }

    public function series()
    {
        return $this->belongsTo(\App\Models\Series::class, 'series_id', 'id');
    }

    public function getStatusLabelAttribute(): string
    {
        return Constant::ARTICLE_STATUS_LABEL_DATA[$this->attributes['status']];
    }

    public function getTypeLabelAttribute(): string
    {
        return Constant::ARTICLE_TYPE_LABEL_DATA[$this->attributes['type']];
    }

    public function scopeTimeBetween($query, $dateRange)
    {
        [$startDate, $endDate] = explode('-', $dateRange);
        $startDate = $this->convertDateToFormat($startDate);
        $endDate = date('Y-m-d', strtotime($this->convertDateToFormat($endDate) . ' +1 day'));
        return $query->where([
            ['created_at', '>=', $startDate],
            ['created_at', '<=', $endDate],
        ]);
    }

    private function convertDateToFormat($date, $format = 'd/m/Y'): string
    {
        $date = trim($date);
        $date = DateTime::createFromFormat($format, $date);
        return $date->format('Y-m-d');
    }
}
