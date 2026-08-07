<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'website',
        'message',
        'ip_address',
        'user_agent',
        'privacy_agreed'
    ];
}