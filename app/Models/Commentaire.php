<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'nom',
        'email',
        'contenu',
        'statut',
        'parent_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Commentaire::class, 'parent_id');
    }

    public function reponses()
    {
        return $this->hasMany(Commentaire::class, 'parent_id');
    }
}
