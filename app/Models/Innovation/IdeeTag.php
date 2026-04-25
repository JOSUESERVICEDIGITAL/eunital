<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdeeTag extends Model
{
    use HasFactory;

    protected $table = 'idee_tags';

    protected $fillable = ['nom', 'slug'];
}
