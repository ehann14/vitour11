<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KonsentrasiKeahlian extends Model
{
    use HasFactory;

    protected $table = 'konsentrasi_keahlian';

    protected $fillable = [
        'program_keahlian_id',
        'nama',
        'slug',
        'deskripsi',
        'kompetensi',
        'prospek_karir',
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
        
        while (KonsentrasiKeahlian::where('slug', $slug)
            ->where('id', '!=', $this->id ?? 0)
            ->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        $this->attributes['slug'] = $slug;
    }

    /**
     * ✅ RELATIONSHIP: KonsentrasiKeahlian belongs to ProgramKeahlian
     */
    public function program()
    {
        return $this->belongsTo(ProgramKeahlian::class, 'program_keahlian_id');
    }
}