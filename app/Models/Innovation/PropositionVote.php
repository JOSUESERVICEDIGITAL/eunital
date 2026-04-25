<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropositionVote extends Model
{
    use HasFactory;

    protected $table = 'proposition_votes';

    protected $fillable = [
        'proposition_amelioration_id',
        'user_id',
        'vote'
    ];
}
