<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Salle extends Model
{
    use HasFactory;

    protected $table = 'salles';

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'cour_id',
        'module_id',
        'acces_salle_id',
        'type_salle',
        'is_active',
        'is_open',
        'image_couverture',
        'parametres',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_open' => 'boolean',
        'parametres' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function ($salle) {
            if (empty($salle->slug) && !empty($salle->titre)) {
                $baseSlug = Str::slug($salle->titre);
                $slug = $baseSlug;
                $i = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $i;
                    $i++;
                }

                $salle->slug = $slug;
            }
        });
    }

    public function cour()
    {
        return $this->belongsTo(Cour::class, 'cour_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function accesSalle()
    {
        return $this->belongsTo(AccesSalle::class, 'acces_salle_id');
    }

    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getStatutLabelAttribute(): string
    {
        if (!$this->is_active) {
            return 'Inactive';
        }

        return $this->is_open ? 'Ouverte' : 'Fermée';
    }

    public function getStatutClassAttribute(): string
    {
        if (!$this->is_active) {
            return 'secondary';
        }

        return $this->is_open ? 'success' : 'warning';
    }
}
