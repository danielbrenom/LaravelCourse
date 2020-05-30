<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property bool verified
 * @property bool admin
 * @property string email
 * @property string name
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public static function generateVerificationToken()
    {
        return md5(time());
    }

    /*
     * Mutators and Accessors
     */

    public function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name){
        return ucwords($this->attributes['name']);
    }

    public function setEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }
}
