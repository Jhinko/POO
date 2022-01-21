<?php 
namespace App\Helpers;

class RouteHelper {

    public static function redirect(string $url) : void
    {
        header("location: ".$url);
        exit();
    }
}

