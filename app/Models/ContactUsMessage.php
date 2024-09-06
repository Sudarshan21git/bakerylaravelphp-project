<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsMessage extends Model
{
    use HasFactory;
    protected $table = 'contact_us_messages';

    // Specify which attributes are mass assignable
    protected $fillable = ['name', 'email', 'subject', 'message'];
}
