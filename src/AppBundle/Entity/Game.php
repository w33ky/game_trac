<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="game")
 */
class Game
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $platform;

    /**
     * @ORM\Column(type="date")
     */
    private $lastPlayed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFinished;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDropped;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastPlayed
     *
     * @param \DateTime $lastPlayed
     *
     * @return Game
     */
    public function setLastPlayed($lastPlayed)
    {
        $this->lastPlayed = $lastPlayed;

        return $this;
    }

    /**
     * Get lastPlayed
     *
     * @return \DateTime
     */
    public function getLastPlayed()
    {
        return $this->lastPlayed;
    }

    /**
     * Set isFinished
     *
     * @param boolean $isFinished
     *
     * @return Game
     */
    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    /**
     * Get isFinished
     *
     * @return boolean
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }

    /**
     * Set isDropped
     *
     * @param boolean $isDropped
     *
     * @return Game
     */
    public function setIsDropped($isDropped)
    {
        $this->isDropped = $isDropped;

        return $this;
    }

    /**
     * Get isDropped
     *
     * @return boolean
     */
    public function getIsDropped()
    {
        return $this->isDropped;
    }

    /**
     * Set platform
     *
     * @param string $platform
     *
     * @return Game
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }
}
