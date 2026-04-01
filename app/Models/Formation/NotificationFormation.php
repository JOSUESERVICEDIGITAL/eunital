<?php

namespace App\Models\Formation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class NotificationFormation extends Model
{
    protected $table = 'notifications_formation';

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'data',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopeNonLues($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeLues($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Méthodes
    public function marquerCommeLue()
    {
        $this->is_read = true;
        $this->read_at = now();
        $this->save();
        
        return $this;
    }
}