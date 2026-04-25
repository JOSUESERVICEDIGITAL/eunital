<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationDocument extends Model
{
    use HasFactory;

    protected $table = 'innovation_documents';

    protected $fillable = [
        'innovation_id',
        'titre',
        'type_document',
        'fichier',
        'uploaded_by'
    ];

    public function innovation()
    {
        return $this->belongsTo(Innovation::class);
    }
}
