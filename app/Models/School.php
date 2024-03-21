<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class School extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'school_id',
        'profile_image',
        'password',
        'role',
        'school_name',
        'address',
        'city',
        'pin_code',
        'mobile_number',
        'whatsapp_number',
        'verify_status',
        'affiliation_level',
        'board_type',
        'opt_code',
        'notes',
    ];
}
