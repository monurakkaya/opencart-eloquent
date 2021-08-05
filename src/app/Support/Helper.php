<?php


namespace App\Support;


final class Helper
{
    public static $registry;

    public function setRegistry($registry = null)
    {
        if (!is_null($registry)) {
            self::$registry = $registry;
        }
    }

    public static function session($key, $default = null)
    {
        return self::$registry->get('session')->data[$key] ?? $default;
    }

    //ocmod
}