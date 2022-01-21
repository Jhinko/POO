<?php

namespace App\Controller;

use App\Entity\Book;
use App\Helpers\EntityManagerHelper as Em;
use App\Helpers\SerializeHelper as Serializer;
use App\Models\AbstractRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class LivreControllers
{
    public array $SELECT = ['title' => '', 'author' => '',];


    public function index()
    {
        try {
            $entityManager = Em::getEntityManager();
            $class = new ClassMetadata("App\Entity\Book");
            $bookRepository = new AbstractRepository($entityManager, $class);
            $livre = $bookRepository->findAll();
            // print("<pre>" . print_r($livre, true) . "</pre>");
            
            foreach ($livre as $k => $book) {
                
                $author = $book->getAuthor();
                $title = $book->getTitle();
                echo "<p>" . $title . ' ' . "<span style='color:#C8AD7F'>" . ' '. $author . "</spans>" .' ' . "</p><br/>";
            }
        } catch (\Throwable $th) {
            exit("Une erreur est survenu lors de la récupération des livres.");
        }
    }
    
    
    public function showForm()
    {
        include('src/vues/AddForm.php');
    }
    
    public function add()
    {

        if (isset($_POST['title'], $_POST['author'])) 
        {
            $title = $_POST['title'];
            $author = $_POST['author'];
        }else
            throw new Exception("Error Processing Request");
        
            $entityManager = Em::getEntityManager();
            $book = new Book($title, $author);
            $entityManager->persist($book);

        try {
            $entityManager->flush();
        } catch (\Throwable $th) {
            exit("Error Processing Request");
            }
    }



    public function modify(?int $iUserID, ?array $p = [])
    {
        foreach ($this->SELECT as $key => $value) {
            try {
                if (!array_key_exists($key, $p)) {
                    throw new \Exception("No key $key found");
                }
                
                $this->SELECT[$key] = htmlentities(strip_tags($p[$key]));
                
                if (empty($this->SELECT[$key])) {
                    throw new \Exception("key $key becomes empty , due to not allowed char");
                }
            } catch (\Throwable $c) {
                exit($c->getMessage());
            }
        }
        $entityManager = Em::getEntityManager();
        $bookRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Book"));
        $book = $bookRepository->find($iUserID);

        $book->setTitle($this->SELECT['title'])->setAuthor($this->SELECT['author']);
        
        $entityManager->persist($book); 
        $entityManager->flush();
        print(Serializer::getSerializer()->serialize($bookRepository->find($iUserID), 'json'));
    }


    // protected function remove($author, $title, $isFlush = false)
    // {
    //     $this->em->remove($author, $title);
    //     if ($isFlush) {
    //         $this->em->flush($author, $title);
    //     }
    // }

    public function delete($iUserID)
    {
        $entityManager = Em::getEntityManager();
        $bookRepository = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Book"));
        $book = $bookRepository->find($iUserID);
        $entityManager->remove($book);

        try {
            $entityManager->flush();
        } catch (\Throwable $rm) {
            exit($rm->getMessage());
        }
    }
    
}