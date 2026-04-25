<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperimentationSite extends Model
{
    use HasFactory;

    protected $table = 'experimentation_sites';

    protected $fillable = [
        'experimentation_id',
        'nom_site',
        'region_id',
        'province_id',
        'commune_id',
        'responsable_local',
        'contact_local',
    ];

    public function experimentation(): BelongsTo
    {
        return $this->belongsTo(Experimentation::class, 'experimentation_id');
    }
}