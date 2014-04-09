<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Facilitation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\FacilitationRepository")
 */
class Facilitation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDetection", type="datetime")
     */
    private $dateDetection;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReglement", type="datetime",nullable=true)
     */
    private $dateReglement;

  /**
     *
     * @ORM\ManyToOne(targetEntity="Gestion\PassBundle\Entity\typeFacilitation")
     * 
     **/
    private $typeFacilitation;
    
     /**
     * @var \String
     *
     * @ORM\Column(name="service", type="string")
     */
    private $service;

      
    
    /**
     * @var \String
     *
     * @ORM\Column(name="emplacement", type="string")
     */
    private $emplacement;

      
    /**
     * @var \String
     *
     * @ORM\Column(name="zone", type="string")
     */
    private $zone;
 /**
     * @var \String
     *
     * @ORM\Column(name="user", type="string")
     */
    private $user;

    
    
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
     * Set dateDetection
     *
     * @param \DateTime $dateDetection
     * @return Facilitation
     */
    public function setDateDetection($dateDetection)
    {
        $this->dateDetection = $dateDetection;
    
        return $this;
    }

    /**
     * Get dateDetection
     *
     * @return \DateTime 
     */
    public function getDateDetection()
    {
        return $this->dateDetection;
    }

    /**
     * Set dateReglement
     *
     * @param \DateTime $dateReglement
     * @return Facilitation
     */
    public function setDateReglement($dateReglement)
    {
        $this->dateReglement = $dateReglement;
    
        return $this;
    }

    /**
     * Get dateReglement
     *
     * @return \DateTime 
     */
    public function getDateReglement()
    {
        return $this->dateReglement;
    }

    /**
     * Set typeFacilitation
     *
     * @param \Gestion\PassBundle\Entity\typeFacilitation $typeFacilitation
     * @return Facilitation
     */
    public function setTypeFacilitation(\Gestion\PassBundle\Entity\typeFacilitation $typeFacilitation = null)
    {
        $this->typeFacilitation = $typeFacilitation;
    
        return $this;
    }

    /**
     * Get typeFacilitation
     *
     * @return \Gestion\PassBundle\Entity\typeFacilitation 
     */
    public function getTypeFacilitation()
    {
        return $this->typeFacilitation;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return Facilitation
     */
    public function setService($service)
    {
        $this->service = $service;
    
        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set emplacement
     *
     * @param string $emplacement
     * @return Facilitation
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
    
        return $this;
    }

    /**
     * Get emplacement
     *
     * @return string 
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set zone
     *
     * @param string $zone
     * @return Facilitation
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Get zone
     *
     * @return string 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Facilitation
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
}