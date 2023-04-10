<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use DB;


class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $error = null;

    protected $fillable = [
        'name', 'email', 'password','role', 'active', 'year'
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

    public function getAuthIdentifier()
    {
        return $this->email;
    }
     /**
     * Get the password for the user.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getAuthPassword()
    {
        throw new \BadMethodCallException('Unexpected method [getAuthPassword] call');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getRememberToken()
    {
        throw new \BadMethodCallException('Unexpected method [getRememberToken] call');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     * @codeCoverageIgnore
     */
    public function setRememberToken($value)
    {
        throw new \BadMethodCallException('Unexpected method [setRememberToken] call');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getRememberTokenName()
    {
        throw new \BadMethodCallException('Unexpected method [getRememberTokenName] call');
    }


    public function fetchUserByCredentials($credentials){

        //query the database for user data        
        $user=$this->where('email', $credentials['email'])->first();
        
        if($user == NULL){
            if(DB::table('shortlisted_student')->where(['email' => $credentials['email']])->exists()){
                $user=User::updateOrCreate([
                    'email' => $credentials['email']
                ],[
                    'name' => $credentials['name'], 
                    'password' => 'null', 
                    'role' => '1', 
                    'active' => '1',
                    'year' => '2023',
                ]);
            } else {
                $user=User::updateOrCreate([
                    'email' => $credentials['email']
                ],[ 
                    'name' => $credentials['name'],                     
                    'password' => 'null', 
                    'role' => '0', 
                    'active' => '0',
                    'year' => '2023',
                ]);     
            }    
        }   

        return $user;
    }
}
