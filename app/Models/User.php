<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'phone',
        'email',
        'password',
        'role',
        'admin_action',
        'department_id',
        'created_date'
    ];


    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function department(){
        return  $this->belongsTo('App\Models\Department');
    }
    
    
    
    public function bonus(){
        return  $this->hasMany('App\Models\Bonus');
    }

    
    public function demandes(){
        return  $this->hasMany('App\Models\Demande');
    }
    
    public function notif(){
        return  $this->hasMany('App\Models\Notification');
    }

    public function isAdmin() {
        return $this->role === 'admin';
     }

     public function isManager() {
        return $this->role === 'manager';
     }

     public function isEmp() {
        return $this->role === 'employe';
     }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'account_activate_at' => 'datetime',
    ];
}
