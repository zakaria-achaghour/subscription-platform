<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'url'];

     /**
     * Get all the posts for the website.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get all the subscriptions for the website.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
