<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'title',
        'slug',
        'level',
        'type',
        'image_path',
        'ranking',
        'location',
        'date',
        'description',
        'student_name',
        'student_class',
        'advisor_name',
        'advisor_title',
        'is_active',
        'order',
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Auto-generate unique slug dari title
     * Jika slug sudah ada, tambahkan angka: -1, -2, dst.
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        
        // Generate slug dasar
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 1;
        
        // Loop sampai dapat slug yang belum dipakai
        // (kecuali sedang update data ini sendiri)
        while (Achievement::where('slug', $slug)
            ->where('id', '!=', $this->id ?? 0)
            ->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        $this->attributes['slug'] = $slug;
    }

    /**
     * Helper: Get URL gambar lengkap
     */
    public function getImageUrlAttribute()
    {
        return $this->image_path 
            ? asset('storage/' . $this->image_path) 
            : asset('images/default-achievement.jpg');
    }

    /**
     * Helper: Format tanggal untuk tampilan
     */
    public function getFormattedDateAttribute()
    {
        return $this->date ? $this->date->format('d F Y') : '-';
    }

    /**
     * Helper: Badge color berdasarkan level
     */
    public function getLevelBadgeClassAttribute()
    {
        $colors = [
            'Kota' => 'badge-kota',
            'Provinsi' => 'badge-provinsi',
            'Nasional' => 'badge-nasional',
            'Internasional' => 'badge-internasional',
        ];
        return $colors[$this->level] ?? 'badge-secondary';
    }
}