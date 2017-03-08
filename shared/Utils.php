<?php

require_once "models/User.php";
class Utils{

    public static function getAuthDiv()
    {
        if (!isset($_SESSION['login']) || !$_SESSION['login']){

            return  "<a href='" . route("auth", "showLoginForm") . "' >Đăng nhập</a> | <a href='" . route("auth", "showRegistrationForm") . "'>Đăng ký</a>";
        }

        $user = unserialize($_SESSION['currentUser']);

        return "<a href='#' >" . $user->name . "</a> | <a href='" . route("auth", "logout") . "'>Đăng xuất</a>";

    }

    public static function getUser()
    {
        if (!isset($_SESSION['login']) || !$_SESSION['login']){

            return  null;
        }

        return  unserialize($_SESSION['currentUser']);
    }
}