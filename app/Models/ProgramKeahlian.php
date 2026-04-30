<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProgramKeahlian extends Model
{
    protected $table = 'program_keahlian';
    
    protected $fillable = [
        'nama',
        'slug',
        'singkatan',
        'deskripsi',
        'visi',
        'misi',
        'logo',
        'urutan',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];
    
    /**
     * Accessor untuk URL logo
     */
    protected function logoUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->logo 
                ? asset('storage/' . $this->logo) 
                : asset('images/default-program.png'),
        );
    }
    
    /**
     * Scope untuk program aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}