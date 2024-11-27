<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * Get the website that owns the subscription.
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }
}
