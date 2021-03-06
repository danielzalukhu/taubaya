<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ROLE', 'STAFFS_ID', 'STUDENTS_ID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'STUDENTS_ID');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'STAFFS_ID');
    }

    public function guardian()
    {
        return $this->belongsTo('App\Guardian', 'GUARDIANS_ID');
    }
}
