<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdeeVote extends Model
{
    use HasFactory;

    protected $table = 'idee_votes';

    protected $fillable = [
        'idee_innovation_id',
        'user_id',
        'vote'
    ];
}
