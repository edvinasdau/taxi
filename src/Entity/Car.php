<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    const DIESEL = 0;
    const BENSIN = 1;
    const HYBRID = 2;
    const ELECTRIC = 3;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $make;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="car")
     */
    private $trips;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Driver", mappedBy="cars")
     */
    private $drivers;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
        $this->trips = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @param mixed $make
     */
    public function setMake($make): void
    {
        $this->make = $make;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getTypeString()
    {
        switch($this->getType()){
            case self::DIESEL:
                return 'Diesel';
            case self::BENSIN:
                return 'Bensin';
                case self::HYBRID:
                return 'Hybrid';
                case self::ELECTRIC:
                return 'Electric';
        }
    }

    /**
     * @return mixed
     */
    public function getTrips()
    {
        return $this->trips;
    }

    /**
     * @return mixed
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    public function addDriver(Driver $driver)
    {
        if(! $this->drivers->contains($driver)){
            return;
        }

        $driver->addCar($this);
        $this->drivers[] = $driver;
    }

    public function removeDriver(Driver $driver)
    {
        if(! $this->drivers->contains($driver)){
            return;
        }

        $driver->removeCar($this);
        $this->drivers->removeElement($driver);
    }
}
