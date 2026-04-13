<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccesSalle extends Model
{
    use HasFactory;

    protected $table = 'acces_salles';

    protected $fillable = [
        'cour_id',
        'code_acces',
        'generated_at',
        'expires_at',
        'is_active',
        'max_utilisateurs',
        'utilisateurs_actifs',
        'utilisateurs_connexion',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'max_utilisateurs' => 'integer',
        'utilisateurs_actifs' => 'array',
        'utilisateurs_connexion' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function cour()
    {
        return $this->belongsTo(Cour::class, 'cour_id');
    }
// Vérifiez que cette relation existe
public function salle()
{
    return $this->hasOne(Salle::class, 'acces_salle_id');
}

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActifs($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeExpires($query)
    {
        return $query->whereNotNull('expires_at')
            ->where('expires_at', '<=', now());
    }

    public function scopeDesactives($query)
    {
        return $query->where('is_active', false);
    }

    /*
    |--------------------------------------------------------------------------
    | Accesseurs
    |--------------------------------------------------------------------------
    */

    public function getEstValideAttribute(): bool
    {
        return $this->is_active && (
            is_null($this->expires_at) || $this->expires_at->isFuture()
        );
    }

    public function getEstExpireAttribute(): bool
    {
        return !is_null($this->expires_at) && $this->expires_at->isPast();
    }

    public function getNbUtilisateursActifsAttribute(): int
    {
        return count($this->utilisateurs_actifs ?? []);
    }

    public function getPlacesRestantesAttribute(): ?int
    {
        if (is_null($this->max_utilisateurs)) {
            return null;
        }

        return max(0, $this->max_utilisateurs - $this->nb_utilisateurs_actifs);
    }

    public function getStatutLabelAttribute(): string
    {
        if (!$this->is_active) {
            return 'Désactivé';
        }

        if ($this->est_expire) {
            return 'Expiré';
        }

        return 'Actif';
    }

    public function getStatutClassAttribute(): string
    {
        if (!$this->is_active) {
            return 'secondary';
        }

        if ($this->est_expire) {
            return 'danger';
        }

        return 'success';
    }

    /*
    |--------------------------------------------------------------------------
    | Méthodes métiers
    |--------------------------------------------------------------------------
    */

    public function limiteAtteinte(): bool
    {
        if (is_null($this->max_utilisateurs)) {
            return false;
        }

        return $this->nb_utilisateurs_actifs >= $this->max_utilisateurs;
    }

    public function ajouterUtilisateur(int $userId): self
    {
        $utilisateurs = $this->utilisateurs_actifs ?? [];
        $connexions = $this->utilisateurs_connexion ?? [];

        if (!in_array($userId, $utilisateurs)) {
            if ($this->limiteAtteinte()) {
                return $this;
            }

            $utilisateurs[] = $userId;
        }

        $connexions[$userId] = now()->toDateTimeString();

        $this->update([
            'utilisateurs_actifs' => array_values($utilisateurs),
            'utilisateurs_connexion' => $connexions,
        ]);

        return $this->fresh();
    }

    public function retirerUtilisateur(int $userId): self
    {
        $utilisateurs = collect($this->utilisateurs_actifs ?? [])
            ->reject(fn ($id) => (int) $id === (int) $userId)
            ->values()
            ->all();

        $connexions = $this->utilisateurs_connexion ?? [];
        unset($connexions[$userId]);

        $this->update([
            'utilisateurs_actifs' => $utilisateurs,
            'utilisateurs_connexion' => $connexions,
        ]);

        return $this->fresh();
    }

    public function viderUtilisateurs(): self
    {
        $this->update([
            'utilisateurs_actifs' => [],
            'utilisateurs_connexion' => [],
        ]);

        return $this->fresh();
    }

    public function utilisateursConnectes()
    {
        $ids = $this->utilisateurs_actifs ?? [];

        return User::whereIn('id', $ids)->get();
    }
    
}
