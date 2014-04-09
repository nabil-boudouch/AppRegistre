<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Anomalie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\AnomalieRepository")
 */
class Anomalie {

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
     **/
    
    private $dateReglement;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Gestion\PassBundle\Entity\Equipement")
     * 
     **/
    
    private $equipement;
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set dateDetection
     *
     * @param \DateTime $dateDetection
     * @return Anomalie
     */
    public function setDateDetection($dateDetection) {
        $this->dateDetection = $dateDetection;

        return $this;
    }

    /**
     * Get dateDetection
     *
     * @return \DateTime 
     */
    public function getDateDetection() {
        return $this->dateDetection;
    }

    /**
     * Set dateReglement
     *
     * @param \DateTime $dateReglement
     * @return Anomalie
     */
    public function setDateReglement($dateReglement) {
        $this->dateReglement = $dateReglement;

        return $this;
    }

    /**
     * Get dateReglement
     *
     * @return \DateTime 
     */
    public function getDateReglement() {
        return $this->dateReglement;
    }

    /**
     * Set equipement
     *
     * @param \Gestion\PassBundle\Entity\Equipement $equipement
     * @return Anomalie
     */
    public function setEquipement(\Gestion\PassBundle\Entity\Equipement $equipement = null) {
        $this->equipement = $equipement;

        return $this;
    }

    /**
     * Get equipement
     *
     * @return \Gestion\PassBundle\Entity\Equipement 
     */
    public function getEquipement() {
        return $this->equipement;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return Anomalie
     */
    public function setService($service) {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService() {
        return $this->service;
    }


    /**
     * Set emplacement
     *
     * @param string $emplacement
     * @return Anomalie
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
     * @return Anomalie
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
     * @return Anomalie
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