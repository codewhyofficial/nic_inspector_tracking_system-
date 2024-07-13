<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserLogin extends Model implements JWTSubject
{

    protected $table = 'user_login';

    // Add any other necessary properties
    protected $primaryKey = 'user_id'; // Assuming 'user_id' is the primary key
    public $timestamps = true; // Assuming there are no timestamp fields

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
}
