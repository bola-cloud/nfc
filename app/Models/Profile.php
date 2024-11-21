<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bio', 'website', 'profile_image', 'company', 'job_title'];

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
}
