<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str helper for slug generation

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bio', 'website', 'profile_image', 'company', 'job_title', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function links()
    {
        return $this->hasMany(ProfileLink::class);
    }

    // Accessor to get the full URL of the profile image
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image ? asset('storage/' . $this->profile_image) : null;
    }

    public static function boot()
    {
        parent::boot();

        // Automatically create a slug when a profile is created
        static::creating(function ($profile) {
            $profile->slug = $profile->slug ?? Str::slug($profile->user->name, '-');
        });

        // Ensure the slug is updated when the name changes
        static::updating(function ($profile) {
            $profile->slug = $profile->slug ?? Str::slug($profile->user->name, '-');
        });
    }
}
