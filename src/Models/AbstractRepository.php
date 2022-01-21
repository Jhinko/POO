<?php

namespace App\Models;

use Doctrine\ORM\EntityRepository;
use App\Helpers\EntityManagerHelper as Em;

class AbstractRepository extends EntityRepository
{
    /**
     * @param string $entity The entity name (with his namespace)
     */
    public function getGreaterThan(int $number) : mixed
    {
        $entityManager = Em::getEntityManager();

        $class_name = $this->getClassName();
        $query = $entityManager->createQuery("SELECT e FROM $class_name e WHERE e.id > $number");
        $result = $query->getResult();

        return $result;
    }
}
