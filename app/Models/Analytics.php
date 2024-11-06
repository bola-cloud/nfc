<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = ['nfc_tag_id', 'ip_address', 'location', 'user_agent', 'scanned_at'];

    public function nfcTag()
    {
        return $this->belongsTo(NfcTag::class);
    }
}
