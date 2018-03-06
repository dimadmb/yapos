<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PositionRepository")
 */
class Position
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="properties", type="text", nullable=true)
     */
    private $properties;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="KeyWord", inversedBy="positions")
	 */
	private $keyWord;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Position
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }



    /**
     * Set properties
     *
     * @param string $properties
     *
     * @return Position
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get properties
     *
     * @return string
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set keyWord
     *
     * @param \AppBundle\Entity\KeyWord $keyWord
     *
     * @return Position
     */
    public function setKeyWord(\AppBundle\Entity\KeyWord $keyWord = null)
    {
        $this->keyWord = $keyWord;

        return $this;
    }

    /**
     * Get keyWord
     *
     * @return \AppBundle\Entity\KeyWord
     */
    public function getKeyWord()
    {
        return $this->keyWord;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Position
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}
