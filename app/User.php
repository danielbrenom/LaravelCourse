<?php

namespace App;

use App\Domain\Observers\Tables\UserObserver;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property bool verified
 * @property bool admin
 * @property string email
 * @property string name
 * @see UserObserver
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

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
        'admin',
        'verified',
        'password',
        'remember_token',
        'verification_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $transformer = UserTransformer::class;

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
