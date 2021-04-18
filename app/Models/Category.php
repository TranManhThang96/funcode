<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Exception;
use DateTimeInterface;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'parent_id',
        'created_by',
        'updated_by'
    ];

//    protected $appends = ['created_at_format', 'updated_at_format'];
//
//    public function getCreatedAtFormatAttribute()
//    {
//        try {
//            return Carbon::parse($this->created_at)->format('Y/m/d H:i:s');
//        } catch (Exception $exception) {
//            return '';
//        }
//    }
//
//    public function getUpdatedAtFormatAttribute()
//    {
//        try {
//            return Carbon::parse($this->updated_at)->format('Y/m/d H:i:s');
//        } catch (Exception $exception) {
//            return '';
//        }
//    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y/m/d H:i:s');
    }
}
