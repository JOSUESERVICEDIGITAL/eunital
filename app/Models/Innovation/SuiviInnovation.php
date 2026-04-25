<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuiviInnovation extends Model
{
    use HasFactory;

    protected $table = 'suivis_innovation';

    protected $fillable = [
        'innovation_id',
        'date_suivi',
        'statut_global',
        'resume',
        'progression',
        'risques_majeurs',
        'recommandations',
        'redige_par',
    ];

    protected $casts = [
        'date_suivi' => 'date',
        'progression' => 'integer',
    ];

    public function innovation(): BelongsTo
    {
        return $this->belongsTo(Innovation::class, 'innovation_id');
    }

    public function redacteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'redige_par');
    }

    public function etapes(): HasMany
    {
        return $this->hasMany(SuiviEtape::class, 'suivi_innovation_id');
    }

    public function blocages(): HasMany
    {
        return $this->hasMany(SuiviBlocage::class, 'suivi_innovation_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(SuiviNotification::class, 'suivi_innovation_id');
    }
}
