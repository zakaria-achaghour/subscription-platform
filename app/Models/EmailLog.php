<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    //
    protected $fillable = ['post_id', 'subscription_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
