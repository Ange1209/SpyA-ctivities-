<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Demande extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'ref',
        'type',
        'motif',
        'debut',
        'fin',
        'statut',
        'user_id',
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function user(){
        return  $this->belongsTo('App\Models\User');
    }
}

