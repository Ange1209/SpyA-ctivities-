<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    
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

     
    public function notif(){
        return  $this->hasMany('App\Models\Notification');
    }
    
    public function user(){
        return  $this->belongsTo('App\Models\User');
    }
}
