<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationAlerte extends Model
{
    use HasFactory;

    protected $table = 'innovation_alertes';

    protected $fillable = [
        'innovation_portefeuille_id',
        'innovation_id',
        'type_alerte',
        'niveau_criticite',
        'message',
        'statut',
        'declenchee_par',
        'traitee_par',
        'date_traitement'
    ];

    protected $casts = [
        'date_traitement' => 'datetime'
    ];

    public function innovation()
    {
        return $this->belongsTo(Innovation::class);
    }

    public function portefeuille()
    {
        return $this->belongsTo(InnovationPortefeuille::class);
    }
}
