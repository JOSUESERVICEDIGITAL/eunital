<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentiteVisuelle extends Model
{
    use HasFactory;

    protected $table = 'identites_visuelles';

    protected $fillable = [
        'nom',
        'description',
        'logo',
        'palette_couleurs',
        'typographie',
        'statut',
        'client_studio_id',
    ];

    public function client()
    {
        return $this->belongsTo(ClientStudio::class, 'client_studio_id');
    }
}
