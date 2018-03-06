<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domain
 *
 * @ORM\Table(name="domain")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DomainRepository")
 */
class Domain
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255)
     */
    private $domain;
	
	
    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="KeyWord", mappedBy="domain")
	 */
	private $keyWords;


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
     * Set name
     *
     * @param string $name
     *
     * @return Domain
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
     * Set domain
     *
     * @param string $domain
     *
     * @return Domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->keyWords = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add keyWord
     *
     * @param \AppBundle\Entity\KeyWord $keyWord
     *
     * @return Domain
     */
    public function addKeyWord(\AppBundle\Entity\KeyWord $keyWord)
    {
        $this->keyWords[] = $keyWord;

        return $this;
    }

    /**
     * Remove keyWord
     *
     * @param \AppBundle\Entity\KeyWord $keyWord
     */
    public function removeKeyWord(\AppBundle\Entity\KeyWord $keyWord)
    {
        $this->keyWords->removeElement($keyWord);
    }

    /**
     * Get keyWords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeyWords()
    {
        return $this->keyWords;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Domain
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }
}
