<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class Session
{
    public static function init()
    {
        if (!isset($_SESSION)) {
            @session_start();
        }
    }
    
    public static function set($key, $value)
    {
        Session::init();
        $_SESSION[$key] = $value;
    }
    
    public static function get($key)
    {
        Session::init();

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }
    
    public static function destroy()
    {
        Session::init();
        session_destroy();
    }
}