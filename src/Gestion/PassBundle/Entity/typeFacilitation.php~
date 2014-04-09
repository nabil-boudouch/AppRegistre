<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * typeFacilitation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\typeFacilitationRepository")
 */
class typeFacilitation
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
     * @var \String
     *
     * @ORM\Column(name="typeFacilitation", type="string")
     */
    private $typeFacilitation;

    /**
     * @var \String
     *
     * @ORM\Column(name="service", type="string")
     */
    private $service;

    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Gestion\PassBundle\Entity\Emplacement")
     *
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
     * Set typeFacilitation
     *
     * @param string $typeFacilitation
     * @return typeFacilitation
     */
    public function setTypeFacilitation($typeFacilitation)
    {
        $this->typeFacilitation = $typeFacilitation;
    
        return $this;
    }

    /**
     * Get typeFacilitation
     *
     * @return string 
     */
    public function getTypeFacilitation()
    {
        return $this->typeFacilitation;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return typeFacilitation
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
     * @return typeFacilitation
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
public function __toString() {
        return strval($this->getTypeFacilitation())
        ;
    }    
    
    
    /**
     * Set zone
     *
     * @param string $zone
     * @return typeFacilitation
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
}