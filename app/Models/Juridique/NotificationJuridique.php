<?php

namespace App\Models\Juridique;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationJuridique extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     */
    protected $table = 'notifications_juridiques';

    /**
     * Les attributs qui sont mass assignable.
     */
    protected $fillable = [
        'user_id',
        'type',
        'message',
        'data',
        'is_read',
        'read_at',
    ];

    /**
     * Les attributs qui doivent être castés.
     */
    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Les types de notification disponibles.
     */
    const TYPES = [
        'rappel_contrat' => 'Rappel de contrat',
        'rappel_signature' => 'Rappel de signature',
        'rappel_hebdomadaire' => 'Rappel hebdomadaire',
        'nouveau_document' => 'Nouveau document',
        'signature_requise' => 'Signature requise',
        'contrat_expiration' => 'Expiration de contrat',
        'validation_document' => 'Validation de document',
    ];

    /**
     * Relation avec l'utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les notifications non lues.
     */
    public function scopeNonLues($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope pour les notifications lues.
     */
    public function scopeLues($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope pour un type spécifique.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope pour les notifications d'un utilisateur.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Marquer la notification comme lue.
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Marquer la notification comme non lue.
     */
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    /**
     * Vérifier si la notification est lue.
     */
    public function isRead()
    {
        return $this->is_read === true;
    }

    /**
     * Vérifier si la notification est non lue.
     */
    public function isUnread()
    {
        return $this->is_read === false;
    }

    /**
     * Obtenir le libellé du type.
     */
    public function getTypeLabelAttribute()
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    /**
     * Obtenir la classe CSS pour le type.
     */
    public function getTypeCssClassAttribute()
    {
        $classes = [
            'rappel_contrat' => 'warning',
            'rappel_signature' => 'danger',
            'rappel_hebdomadaire' => 'info',
            'nouveau_document' => 'success',
            'signature_requise' => 'primary',
            'contrat_expiration' => 'danger',
            'validation_document' => 'success',
        ];

        return $classes[$this->type] ?? 'secondary';
    }

    /**
     * Obtenir l'icône pour le type.
     */
    public function getTypeIconAttribute()
    {
        $icons = [
            'rappel_contrat' => 'fa-file-contract',
            'rappel_signature' => 'fa-signature',
            'rappel_hebdomadaire' => 'fa-calendar-week',
            'nouveau_document' => 'fa-file-alt',
            'signature_requise' => 'fa-pen',
            'contrat_expiration' => 'fa-clock',
            'validation_document' => 'fa-check-circle',
        ];

        return $icons[$this->type] ?? 'fa-bell';
    }

    /**
     * Formater la date de création.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y à H:i');
    }

    /**
     * Obtenir le temps relatif.
     */
    public function getRelativeTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}