<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModeleDocument extends Model
{
    use SoftDeletes;

    protected $table = 'modeles_documents';

    protected $fillable = [
        'titre',
        'slug',
        'description',
        'type_document_id',
        'contenu_html',
        'contenu_pdf',
        'variables',
        'champs_requis',
        'version',
        'is_default',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'variables' => 'array',
        'champs_requis' => 'array',
        'is_default' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Relations
    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    public function createur()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'modele_document_id');
    }

    // Scopes
    public function scopeActifs($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeParDefaut($query)
    {
        return $query->where('is_default', true);
    }

    // Méthodes
    public function genererDocument(array $donnees)
    {
        $contenu = $this->contenu_html;

        foreach ($donnees as $key => $value) {
            $contenu = str_replace("{{ $key }}", $value, $contenu);
        }

        return $contenu;
    }
}
