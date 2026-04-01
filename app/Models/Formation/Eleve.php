<?php

namespace App\Models\Formation;

use App\Models\User;

class Eleve extends User
{
    // Ce modèle hérite de User
    
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'user_id');
    }
    
    public function modulesInscrits()
    {
        return $this->belongsToMany(Module::class, 'inscriptions', 'user_id', 'module_id')
                    ->withPivot('statut', 'progression')
                    ->withTimestamps();
    }
    
    public function coursSuivis()
    {
        return $this->belongsToMany(Cour::class, 'cours_utilisateur', 'user_id', 'cour_id')
                    ->withPivot('termine', 'progression', 'dernier_acces')
                    ->withTimestamps();
    }
    
    public function progressions()
    {
        return $this->hasMany(Progression::class, 'user_id');
    }
    
    public function soumissions()
    {
        return $this->hasMany(SoumissionDevoir::class, 'user_id');
    }
    
    public function getProgressionGlobaleAttribute()
    {
        $totalCours = $this->coursSuivis()->count();
        if ($totalCours === 0) return 0;
        
        $sommeProgressions = $this->coursSuivis()->sum('progression');
        return round($sommeProgressions / $totalCours);
    }
}