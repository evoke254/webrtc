<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LiveStream extends Model
{
    protected $casts = [
        'uid' => 'string'
    ];
    protected $fillable = [
        'uid', 'title', 'user_id', 'description', 'session_id', 'stream_id', 'token', 'live_url', 'poster', 'room_id', 'live'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uid)) {
                $model->uid = (string) Str::uuid();
            }
        });
    }
}
