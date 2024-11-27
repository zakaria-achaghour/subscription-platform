<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'website_id'];
      /**
     * Get the website that owns the post.
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
