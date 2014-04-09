<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * typeFluidite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\typeFluiditeRepository")
 */
class typeFluidite
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
     * @var string
     *
     * @ORM\Column(name="typeFluidite", type="string", length=255)
     */
    private $typeFluidite;

    /**
     * @var string
     *
     * @ORM\Column(name="Service", type="string", length=255)
     */
    private $service;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Gestion\PassBundle\Entity\Emplacement")
     */
    
    private $emplacement;
    
    
     /**
     * @var string 
     * @ORM\Column(name="zone", type="string", length=255)
     */
    private $zone;
        
    
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
     * Set typeFluidite
     *
     * @param string $typeFluidite
     * @return typeFluidite
     */
    public function setTypeFluidite($typeFluidite)
    {
        $this->typeFluidite = $typeFluidite;
    
        return $this;
    }

    /**
     * Get typeFluidite
     *
     * @return string 
     */
    public function getTypeFluidite()
    {
        return $this->typeFluidite;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return typeFluidite
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
     * @param \Gestion\PassBundle\Entity\Emplacement $emplacement
     * @return typeFluidite
     */
    public function setEmplacement(\Gestion\PassBundle\Entity\Emplacement $emplacement = null)
    {
        $this->emplacement = $emplacement;
    
        return $this;
    }

    /**
     * Get emplacement
     *
     * @return \Gestion\PassBundle\Entity\Emplacement 
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * Set zone
     *
     * @param string $zone
     * @return typeFluidite
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
public function __toString() {
        return strval($this->getTypeFluidite())
        ;
    }    
        
    }