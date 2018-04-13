<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    const MALE = 0;
    const FEMALE = 1;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="client")
     */
    private $trips;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    public function getGenderString()
    {
        switch($this->getGender()){
            case self::MALE:
                return 'Male';
            case self::FEMALE:
                return 'Female';
        }
    }

    /**
     * @return Trip[]
     */
    public function getTrips()
    {
        return $this->trips;
    }
}
