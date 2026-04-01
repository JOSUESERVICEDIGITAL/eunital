<?php

namespace App\Models\Formation;

use App\Models\User;

class Enseignant extends User
{
    // Ce modèle hérite de User
    // Vous pouvez ajouter des méthodes spécifiques aux enseignants
    
    public function coursEnseignes()
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
    
    public function devoirsACorriger()
    {
        $coursIds = $this->coursEnseignes()->pluck('cours.id');
        
        return SoumissionDevoir::whereHas('devoir', function($query) use ($coursIds) {
            $query->whereIn('cour_id', $coursIds);
        })->whereNull('note')->get();
    }
}