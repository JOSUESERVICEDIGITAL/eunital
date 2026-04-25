<?php

namespace App\Models\Innovation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReformeAction extends Model
{
    use HasFactory;

    protected $table = 'reforme_actions';

    protected $fillable = [
        'reforme_interne_id',
        'titre',
        'description',
        'responsable_id',
        'date_debut',
        'date_echeance',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_echeance' => 'date',
    ];

    public function reforme(): BelongsTo
    {
        return $this->belongsTo(ReformeInterne::class, 'reforme_interne_id');
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}