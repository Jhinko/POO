<?php
namespace App\Helpers;

class EntityManagerHelper {
    public static function getEntityManager()
    {
        require('bootstrap.php');

        return $entityManager;
    }
}