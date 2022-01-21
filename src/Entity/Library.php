<?php

namespace App\Entity;

// Inclure dans la classe Library, les classes de typage de doctrine par l'alias nommé ici ORM
use Doctrine\ORM\Mapping as ORM;

// Cette annotation Utilise la Classe Entity de Doctrine pour préciser que cette classe devra être transformer en table 

/**
 * @ORM\Entity
 */
final class Library
{
    // @ORM\Id avec la classe de typage Id; précise que la propriété $id sera une clé primaire
    // @ORM\GeneratedValue avec la classe de typage GeneratedValue; précise que la colonne id sera de type AUTO_INCREMENT
    // @ORM\Column(type="integer") avec la classe de typage Column;Précise que la propriété id sera une colonne dans table Library
    // et que la colonne sera de type entier

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;


    private array $memberList = [];
    private array $documentList = [];

   /**
    * @ORM\Column(length="100")
    */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function addMember(Member $member): self
    {
        array_push($this->memberList, $member);

        return $this;
    }

    public function removeMember(Member $member): self
    {
        foreach ($this->memberList as $key => $mem) {
            if ($member->getId() ===  $mem->getId()) {
                unset($this->memberList[$key]);
            }
        }

        return $this;
    }

    public function AddDocument(Document $document): self
    {
        array_push($this->documentList, $document);

        return $this;
    }

    public function removeDocument(Document $document)
    {
        foreach ($this->documentList as $key => $value) {
            if ($document->getTitle() === $value->getTitle()) {
                unset($this->documentList[$key]);
            }
        }
    }

    /**
     * Get the value of memberList
     */
    public function getMemberList(): array
    {
        return $this->memberList;
    }

    /**
     * Get the value of documentList
     */
    public function getDocumentList(): array
    {
        return $this->documentList;
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}
