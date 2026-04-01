<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Juridique\ModeleDocument;
use App\Models\Juridique\Document;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;


class TypeDocument extends Model
{
    use SoftDeletes;

    protected $table = 'types_documents';

    protected $fillable = [
        'nom',
        'slug',
        'code',
        'description',
        'categorie',
        'icon',
        'couleur',
        'duree_validite',
        'necessite_signature',
        'necessite_timbre',
        'is_active',
        'ordre',
        'metadatas'
    ];

    protected $casts = [
        'necessite_signature' => 'boolean',
        'necessite_timbre' => 'boolean',
        'is_active' => 'boolean',
        'ordre' => 'integer',
        'duree_validite' => 'integer',
        'metadatas' => 'array'
    ];

    // Relations
    public function modeles()
    {
        return $this->hasMany(ModeleDocument::class, 'type_document_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'type_document_id');
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    // Accesseurs
    public function getIconHtmlAttribute()
    {
        return "<i class='{$this->icon}' style='color: {$this->couleur}'></i>";
    }

    public function getDureeValiditeFormateeAttribute()
    {
        if (!$this->duree_validite) return 'Illimitée';
        $jours = $this->duree_validite;
        if ($jours >= 365) return floor($jours / 365) . ' an(s)';
        if ($jours >= 30) return floor($jours / 30) . ' mois';
        return $jours . ' jour(s)';
    }
}
