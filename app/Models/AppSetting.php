<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AppSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    
    protected $hidden = ['media'];

    protected $appends = ['banner'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banner');
    }

    public function getBannerAttribute()
    {
        return $this->getFirstMediaUrl('banner');
    }
}
