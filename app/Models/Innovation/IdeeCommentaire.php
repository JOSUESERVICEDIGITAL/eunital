<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdeeCommentaire extends Model
{
    use HasFactory;

    protected $table = 'idee_commentaires';

    protected $fillable = [
        'idee_innovation_id',
        'auteur_id',
        'commentaire'
    ];
}
