<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'description',
        'user_id',
        'bonus_id',
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function user(){
        return  $this->belongsTo('App\Models\User');
    }

    public function bonus()
    {
        return $this->belongsTo('App\Models\Bonus');
    }
}
