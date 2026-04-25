<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropositionPieceJointe extends Model
{
    use HasFactory;

    protected $table = 'proposition_pieces_jointes';

    protected $fillable = [
        'proposition_amelioration_id',
        'nom_fichier',
        'chemin_fichier',
        'type_fichier',
        'taille',
        'uploaded_by'
    ];
}
