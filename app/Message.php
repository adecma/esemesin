<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public static function balance()
    {
        $lastMessage = static::latest()->first();

        if (empty($lastMessage)) {
            return null;
        }

        $balance = json_decode($lastMessage->response, true);

        return $balance['messages'][0]['remaining-balance'];
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'to', 'phoneNumber');
    }

    public function scopeSearch($query, $word)
    {
        $query->where('messages.to', 'like', "%{$word}%")
            ->orWhere('messages.body', 'like', "%{$word}%");
    }
}
