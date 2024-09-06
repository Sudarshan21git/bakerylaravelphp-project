<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table name if different from the default
    protected $table = 'settings';

    // Define fillable properties for mass assignment
    protected $fillable = [
        'website_name',
        'slogan',
        'logo',
        'favicon',
        'header_logo',
        'footer_logo',
        'phone_no',
        'opt_phone_no',
        'mobile_no',
        'email',
        'opt_email',
        'address',
        'google_map_link',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'youtube_link',
        'about_website',
        'opening_hours',
        'status',
        'created_by',
        'updated_by',
    ];

    // Relationships with users table
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
