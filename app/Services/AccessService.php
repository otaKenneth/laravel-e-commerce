<?php

namespace App\Services;

use App\Models\SystemLogs;
use Illuminate\Support\Facades\Auth;

class AccessService
{
    public static function logLogin($userId, $type)
    {
        $log = "$type Logged In.";
        self::createLog($userId, $type, 'access', $log);
    }

    public static function logLoginError($message)
    {
        self::createLog(null, null, 'access-error', $message);
    }

    public static function logLogout($userId, $type) 
    {
        $log = "$type Logged Out.";
        self::createLog($userId, $type, 'access', $log);
    }

    protected static function createLog($userId, $type, $action, $message)
    {
        SystemLogs::create([
            'user' => $userId,
            'user_type' => $type,
            'action' => $action,
            'data' => $message
        ]);
    }
}
