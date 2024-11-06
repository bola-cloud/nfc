<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Profile extends Model
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['user_id', 'bio', 'website', 'profile_image', 'company', 'job_title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function links()
    {
        return $this->hasMany(ProfileLink::class);
    }
}
