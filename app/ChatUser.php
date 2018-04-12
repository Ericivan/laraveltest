<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    public $table = 'chat_user';


    public static function getUserByFd($fd)
    {
        return self::where('fd', $fd)->first();
    }
}
