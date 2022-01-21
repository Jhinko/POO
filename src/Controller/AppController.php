<?php
namespace App\Controller;

use App\Helpers\SerializeHelper as Serializer;
use Router\Router;

class AppController
{
    public static function index()
    {
        print_r(Serializer::getSerializer()->serialize(["Home"=> "Hello World"], 'json'));
    }

    public function error404() {
        Router::redirect("404");
    }
}
