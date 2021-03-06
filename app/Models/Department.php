<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;


      
    protected $fillable = [
        'uuid',
        'name',
        'description'
    ];

    public function users(){
        return  $this->hasMany('App\Models\User');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
