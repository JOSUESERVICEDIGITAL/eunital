<?php

namespace App\Models\Innovation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReformeRisque extends Model
{
    use HasFactory;

    protected $table = 'reforme_risques';

    protected $fillable = [
        'reforme_interne_id',
        'titre',
        'description',
        'niveau',
        'mesure_mitigation',
    ];

    public function reforme(): BelongsTo
    {
        return $this->belongsTo(ReformeInterne::class, 'reforme_interne_id');
    }
}