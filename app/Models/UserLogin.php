<?php

// app/Models/UserLogin.php

// namespace App\Models;

// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\CanResetPassword;
// use Illuminate\Notifications\Notifiable;
// use Tymon\JWTAuth\Contracts\JWTSubject;
// use App\Notifications\CustomResetPassword;

// class UserLogin extends Authenticatable implements CanResetPassword, JWTSubject
// {
//     use Notifiable;

//     protected $table = 'user_login';

//     protected $primaryKey = 'email';

//     public $timestamps = false;

//     public function getJWTIdentifier()
//     {
//         return $this->getKey();
//     }

//     public function getJWTCustomClaims()
//     {
//         return [];
//     }

//     public function sendPasswordResetNotification($token)
//     {
//         $this->notify(new CustomResetPassword($token));
//     }
// }

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserLogin extends Authenticatable implements CanResetPassword, JWTSubject
{
    use Notifiable;

    protected $table = 'user_login';

    protected $primaryKey = 'email'; // Ensure 'email' is unique if used as primary key

    public $incrementing = false; // Since 'email' is not an incrementing key

    public $timestamps = false;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
    }
}
