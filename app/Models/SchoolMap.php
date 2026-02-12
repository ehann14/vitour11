<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class SchoolMap extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
        'image_name',
        'file_size',
        'file_type',
        'status',
        'order',
        'view_count'
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['image_url', 'thumbnail_url'];

    /**
     * Get full image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image_path 
            ? Storage::disk('public')->url($this->image_path)
            : asset('images/default-map.png');
    }

    /**
     * Get thumbnail URL (untuk preview)
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->image_path 
            ? Storage::disk('public')->url($this->image_path)
            : asset('images/default-thumbnail.png');
    }

    /**
     * Get formatted file size
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    /**
     * Scope: hanya yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: urut berdasarkan order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Scope: urut berdasarkan terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Increment view count
     */
    public function incrementView()
    {
        $this->increment('view_count');
    }

    /**
     * Delete image when record deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($map) {
            if ($map->image_path) {
                Storage::disk('public')->delete($map->image_path);
            }
        });
    }
}