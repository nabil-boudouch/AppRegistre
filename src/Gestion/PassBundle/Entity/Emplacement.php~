<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emplacement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\EmplacementRepository")
 */
class Emplacement
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
     * @ORM\Column(name="nomEmplacement", type="string", length=255, nullable=true)
     */
    private $nomEmplacement;

    /**
      * @ORM\ManyToOne(targetEntity="Gestion\PassBundle\Entity\Zone")
      * @ORM\JoinColumn(nullable=false)
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
     * Set nomEmplacement
     *
     * @param string $nomEmplacement
     * @return Emplacement
     */
    public function setNomEmplacement($nomEmplacement)
    {
        $this->nomEmplacement = $nomEmplacement;
    
        return $this;
    }

    /**
     * Get nomEmplacement
     *
     * @return string 
     */
    public function getNomEmplacement()
    {
        return $this->nomEmplacement;
    }

    /**
     * Set zone
     *
     * @param \Gestion\PassBundle\Entity\Zone $zone
     * @return Emplacement
     */
    public function setZone(\Gestion\PassBundle\Entity\Zone $zone = null)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Get zone
     *
     * @return \Gestion\PassBundle\Entity\Zone 
     */
    public function getZone()
    {
        return $this->zone;
    }
     public function __toString(){
        return strval($this->getNomEmplacement());
        
    }
    
}