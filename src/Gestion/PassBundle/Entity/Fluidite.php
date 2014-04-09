<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fluidite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\FluiditeRepository")
 */
class Fluidite
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

        
    
    //
    
     /**
     *
     * @ORM\ManyToOne(targetEntity="Gestion\PassBundle\Entity\typeFluidite")
     * 
     **/
    private $typeFluidite;

   
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
     * @return Fluidite
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
     * @return Fluidite
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
     * Get typeFluidite
     *
     * @return \Gestion\PassBundle\Entity\typeFluidite 
     */
    public function getTypeFluidite()
    {
        return $this->typeFluidite;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return Fluidite
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
     * @return Fluidite
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
     * @return Fluidite
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
     * Set typeFluidite
     *
     * @param \Gestion\PassBundle\Entity\typeFluidite $typeFluidite
     * @return Fluidite
     */
    public function setTypeFluidite(\Gestion\PassBundle\Entity\typeFluidite $typeFluidite = null)
    {
        $this->typeFluidite = $typeFluidite;
    
        return $this;
    }

    
    
    /**
     * Set user
     *
     * @param string $user
     * @return Fluidite
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