<?php

namespace App\Models\Formation;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Enseignant extends Model
{
    protected $table = 'enseignants';

    protected $fillable = [
        'user_id',
        'specialite',
        'biographie',
        'diplome',
        'annees_experience',
        'competences',
        'reseaux_sociaux',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'competences' => 'array',
        'reseaux_sociaux' => 'array',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cours()
    {
        return $this->belongsToMany(Cour::class, 'cours_enseignant', 'user_id', 'cour_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function coursPrincipaux()
    {
        return $this->belongsToMany(Cour::class, 'cours_enseignant', 'user_id', 'cour_id')
                    ->withPivot('role')
                    ->wherePivot('role', 'principal')
                    ->withTimestamps();
    }
    public function show(Cour $cour)
{
    $cour->load([
        'module',
        'chapitres' => function($query) {
            $query->with('contenus')->orderBy('ordre');
        },
        'enseignants',
        'utilisateurs' => function($query) {
            $query->limit(10);
        },
        'commentaires' => function($query) {
            $query->with('user')->whereNull('parent_id')->limit(10);
        },
        'devoirs'
    ]);

    $stats = [
        'nb_chapitres' => $cour->chapitres->count(),
        'nb_contenus' => $cour->chapitres->sum(function($chapitre) {
            return $chapitre->contenus->count();
        }),
        'nb_etudiants' => $cour->utilisateurs()->count(),
        'progression_moyenne' => $cour->progressions()->avg('progression') ?? 0,
        'taux_completion' => $cour->progressions()->where('termine', true)->count(),
        'note_moyenne' => $cour->devoirs()->with('soumissions')->get()->avg(function($devoir) {
            return $devoir->soumissions->avg('note');
        }) ?? 0
    ];

    // Récupérer les enseignants depuis le modèle Enseignant
    $enseignants = \App\Models\Formation\Enseignant::with('user')
        ->where('is_active', true)
        ->get()
        ->map(function($enseignant) {
            return (object) [
                'id' => $enseignant->user_id,
                'name' => $enseignant->user->name,
                'email' => $enseignant->user->email
            ];
        });

    return view('back.formation.cours.show', compact('cour', 'stats', 'enseignants'));
}
}
