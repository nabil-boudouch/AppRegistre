<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CameraRange
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\CameraRangeRepository")
 */
class CameraRange
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
   * @ORM\ManyToMany(targetEntity="Gestion\PassBundle\Entity\Camera", cascade={"persist"})
   */
     
    public $Camera;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateRange", type="date")
     */
    
    private $dateRange;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeureDebuRange", type="time")
     */
    private $heureDebuRange;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeureFinRange", type="time")
     */
    private $heureFinRange;
    
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
     * Set dateRange
     *
     * @param \DateTime $dateRange
     * @return CameraRange
     */
    public function setDateRange($dateRange)
    {
        $this->dateRange = $dateRange;
    
        return $this;
    }

    /**
     * Get dateRange
     *
     * @return \DateTime 
     */
    public function getDateRange()
    {
        return $this->dateRange;
    }

    /**
     * Set heureDebuRange
     *
     * @param \DateTime $heureDebuRange
     * @return CameraRange
     */
    public function setHeureDebuRange($heureDebuRange)
    {
        $this->heureDebuRange = $heureDebuRange;
    
        return $this;
    }

    /**
     * Get heureDebuRange
     *
     * @return \DateTime 
     */
    public function getHeureDebuRange()
    {
        return $this->heureDebuRange;
    }

    /**
     * Set heureFinRange
     *
     * @param \DateTime $heureFinRange
     * @return CameraRange
     */
    public function setHeureFinRange($heureFinRange)
    {
        $this->heureFinRange = $heureFinRange;
    
        return $this;
    }

    /**
     * Get heureFinRange
     *
     * @return \DateTime 
     */
    public function getHeureFinRange()
    {
        return $this->heureFinRange;
    }

    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Camera = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add Camera
     *
     * @param \Gestion\PassBundle\Entity\Camera $camera
     * @return CameraRange
     */
    public function addCamera(\Gestion\PassBundle\Entity\Camera $camera)
    {
        $this->Camera[] = $camera;
    
        return $this;
    }

    /**
     * Remove Camera
     *
     * @param \Gestion\PassBundle\Entity\Camera $camera
     */
    public function removeCamera(\Gestion\PassBundle\Entity\Camera $camera)
    {
        $this->Camera->removeElement($camera);
    }

    /**
     * Get Camera
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCamera()
    {
        return $this->Camera;
    }
     public function __toString(){
        return strval($this->getCamera());
        
    }
}