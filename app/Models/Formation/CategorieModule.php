<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorieModule extends Model
{
    use SoftDeletes;

    protected $table = 'categories_modules';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'ordre',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ordre' => 'integer'
    ];

    // Relations
    public function modules()
    {
        return $this->hasMany(Module::class, 'categorie_module_id');
    }

    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeActives($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdonnees($query)
    {
        return $query->orderBy('ordre');
    }

    // Accesseurs
    public function getNbModulesAttribute()
    {
        return $this->modules()->count();
    }
}