<?php
namespace App\Controller;

use App\Entity\Visitor;
use App\Helpers\EntityManagerHelper as Em;
use App\Helpers\SerializeHelper as Serializer;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class VisitorController
{
    public array $NEEDLES = ['lastname' => '', 'firstname' => '', 'piece_ident' => ''];

    public function index()
    {
        try {
            $entityManager = Em::getEntityManager();
            $visitorRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
            print(Serializer::getSerializer()->serialize($visitorRepository->findAll(), 'json'));

        } catch (\Throwable $e) {
            exit("Une erreur est survenu lors de la récupération des visiteurs.");
        }
    }

    public function add(?array $posts = [])
    {
        foreach ($this->NEEDLES as $key => $value) {
            try {
                if (!array_key_exists($key, $posts)) {
                    throw new \Exception("No key $key found");
                }

                $this->NEEDLES[$key] = htmlentities(strip_tags($posts[$key]));

                if (empty($this->NEEDLES[$key])) {
                    throw new \Exception("key $key becomes empty , due to not allowed char");
                }
            } catch (\Throwable $e) {
                exit($e->getMessage());
            }
        }

        $visitor = new Visitor($this->NEEDLES['lastname'], $this->NEEDLES['firstname'], $this->NEEDLES['piece_ident']);
        $entityManager = Em::getEntityManager();
        $entityManager->persist($visitor);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant l'ajout du visiteur en base de donnée.");
        }

        $entityManager = Em::getEntityManager();
        $visitorRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
        print(Serializer::getSerializer()->serialize($visitorRepository->findBy(['em' => $this->NEEDLES['lastname']], ['id' => 'DESC'], 1, 0), 'json'));
    }

    public function modify(?int $iUserID, ?array $puts = [])
    {
        foreach ($this->NEEDLES as $key => $value) {
            try {
                if (!array_key_exists($key, $puts)) {
                    throw new \Exception("No key $key found");
                }
                
                $this->NEEDLES[$key] = htmlentities(strip_tags($puts[$key]));
                
                if (empty($this->NEEDLES[$key])) {
                    throw new \Exception("key $key becomes empty , due to not allowed char");
                }
            } catch (\Throwable $e) {
                exit($e->getMessage());
            }
        }
        $entityManager = Em::getEntityManager();
        $visitorRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
        $visitor = $visitorRepository->find($iUserID);

        $visitor->setFirstname($this->NEEDLES['firstname'])->setLastname($this->NEEDLES['lastname'])->setPieceIdent($this->NEEDLES['piece_ident']);
        
        $entityManager->persist($visitor);

        try {
            $entityManager->flush();
        } catch (\Throwable $e) {
            exit("Erreur durant la modification du visiteur en base de donnée.");
        }

        print(Serializer::getSerializer()->serialize($visitorRepository->find($iUserID), 'json'));
    }
}
