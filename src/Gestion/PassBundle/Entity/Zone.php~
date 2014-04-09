<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zone
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\ZoneRepository")
 */
class Zone
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
     * @ORM\Column(name="nomZone", type="string", length=255)
     */
    private $nomZone;


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
     * Set nomZone
     *
     * @param string $nomZone
     * @return Zone
     */
    public function setNomZone($nomZone)
    {
        $this->nomZone = $nomZone;
    
        return $this;
    }

    /**
     * Get nomZone
     *
     * @return string 
     */
    public function getNomZone()
    {
        return $this->nomZone;
    }
    
    public function __toString(){
        return strval($this->getNomZone());
        
    }
}