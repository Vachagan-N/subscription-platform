<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberHistory extends Model
{
    use HasFactory;

    protected $table = 'subscribers_history';

    protected $fillable = [
        'subscriber_id',
        'post_id'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function subscriber() {
        return $this->belongsTo(Subscriber::class);
    }

}
