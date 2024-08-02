<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Activity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    Use SoftDeletes;

    protected $guarded = [];

    //soft deletes
    protected $dates = ['deleted_at'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
   

}
