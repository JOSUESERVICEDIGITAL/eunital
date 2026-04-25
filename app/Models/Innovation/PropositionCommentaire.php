<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropositionCommentaire extends Model
{
    use HasFactory;

    protected $table = 'proposition_commentaires';

    protected $fillable = [
        'proposition_amelioration_id',
        'auteur_id',
        'commentaire'
    ];

    public function proposition()
    {
        return $this->belongsTo(PropositionAmelioration::class);
    }
}
