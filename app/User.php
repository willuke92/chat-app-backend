<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'username', 'photo_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

	public function teams() {
		return $this->belongsToMany('App\Team');
	}
	public function messages() {
		return $this->hasMany('App\Message');
	}
	public function channels() {
		return $this->belongsToMany('App\Channel');
	}

  public function invites() {
    return $this->hasMany('App\Invite', 'invited_user_id', 'id');
  }

  public function sentInvites() {
    return $this->hasMany('App\Invite', 'owner_user_id', 'id');
  }
}
