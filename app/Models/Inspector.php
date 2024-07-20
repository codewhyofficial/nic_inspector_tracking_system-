<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    // Specify the table name
    protected $table = 'inspector';

    // Specify the primary key
    protected $primaryKey = 'UIID';

    // Disable auto-incrementing for non-integer primary keys
    public $incrementing = false;

    // Specify the primary key type if it is not an integer
    protected $keyType = 'string';

    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'UIID', 'name', 'gender', 'DOB', 'nationality', 'place_of_birth',
        'passport_number', 'UNLP_number', 'inspector_rank', 'qualification',
        'professional_experience', 'clearance_certificate', 'isActive', 'remarks'
    ];

    // Disable Laravel's timestamps (created_at, updated_at)
    public $timestamps = false;
}
