<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $license;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Car", inversedBy="driver")
     * @ORM\JoinTable(name="carDriver")
     */
    private $cars;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="driver")
     */
    private $trips;


    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->drivers = new ArrayCollection();
    }

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

    /**
     * @return mixed
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @param mixed $license
     */
    public function setLicense($license): void
    {
        $this->license = $license;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getCars()
    {
        return $this->cars;
    }

    public function addCar(Car $car)
    {
        if(! $this->cars->contains($car)){
            return;
        }
        $this->cars[] = $car;
    }

    public function removeCar(Car $car)
    {
        if(! $this->cars->contains($car)){
            return;
        }
        $this->cars->removeElement($car);
    }
}
