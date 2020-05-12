<?php

namespace App\Lib;


use Pusher\Pusher;

class PusherFactory
{
    public static function make()
    {
        return new Pusher(
            env("PUSHER_APP_KEY", "857abf648584080c1ae0"), // public key
            env("PUSHER_APP_SECRET", "c295de0c81166cba28e2"), // Secret
            env("PUSHER_APP_ID", 999197), // App_id
            array(
                'cluster' => env("MIX_PUSHER_APP_CLUSTER", "mt1"), // Cluster
                'forceTLS' => true
            )
        );
    }
}
