<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panorama extends Model
{
    protected $fillable = [
        'name',
        'scene_id',
        'image_path',
        'type',
        'order',
        'is_active',
        'hotspots',
        'icon'
    ];

    protected $casts = [
        'hotspots' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function getRouteKeyName()
    {
        return 'scene_id';
    }
}