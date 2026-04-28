<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramKeahlian extends Model
{
    use HasFactory;

    protected $table = 'program_keahlian';

    protected $fillable = [
        'nama',
        'singkatan',
        'slug',
        'deskripsi',
        'logo',
        'visi',
        'misi',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Auto-generate unique slug dari nama
     */
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 1;
        
        while (ProgramKeahlian::where('slug', $slug)
            ->where('id', '!=', $this->id ?? 0)
            ->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        $this->attributes['slug'] = $slug;
    }

    /**
     * Helper: Get URL logo
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/default-program.png');
    }
}