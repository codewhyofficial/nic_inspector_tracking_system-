<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

class UserLogin extends Model implements JWTSubject, CanResetPassword
{
    use CanResetPasswordTrait;

    protected $table = 'user_login';

    // Primary key configuration
    protected $primaryKey = 'user_id'; // Assuming 'user_id' is the primary key
    public $timestamps = true; // Set to false if your table does not have timestamp fields

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'user_id', 'password', 'UIID', 'role', 'name'
    ];

    // Specify the attributes that should be hidden for arrays
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Implement the JWTSubject interface methods

    /**
     * Get the identifier that will be stored in the JWT subject claim.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the password reset token for the user.
     *
     * @return string
     */
    public function getResetPasswordToken()
    {
        return $this->password_reset_token;
    }

    /**
     * Set the password reset token for the user.
     *
     * @param string $token
     * @return void
     */
    public function setResetPasswordToken($token)
    {
        $this->password_reset_token = $token;
    }
}
