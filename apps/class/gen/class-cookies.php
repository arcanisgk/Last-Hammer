<?php

class ClassCookiesManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self ::$instance instanceof self) {
            self ::$instance = new self;
        }
        return self ::$instance;
    }

    public function destCookies()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $name = trim(explode('=', $cookie)[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }
    }

    public function initCookies()
    {
        setcookie(session_name(), session_id(), SESSION_TIME_OUT, "/", '', COOKIES_SECURITY, COOKIES_HTTPONLY);
    }
}
