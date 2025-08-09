<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;


class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y H:i');
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y H:i');
    }
}
