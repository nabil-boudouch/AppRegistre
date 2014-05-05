<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gestion\PassBundle\Entity\Camera;
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
     * @var \DateTime
     *
     * @ORM\Column(name="DateRange", type="datetime")
     */
    
    private $dateRange;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeureDebuRange", type="datetime")
     */
    private $heureDebuRange;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeureFinRange", type="datetime")
     */
    private $heureFinRange;

     /**
      * @ORM\ManyToOne(targetEntity="Gestion\PassBundle\Entity\Camera")
      * 
      */
    private $camera;
    
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
     
     public function __toString(){
        return strval($this->getId());        
    }
    /**
     * Set camera
     *
     * @param \Gestion\PassBundle\Entity\Camera $camera
     * @return CameraRange
     */
    public function setCamera(\Gestion\PassBundle\Entity\Camera $camera)
    {
        $this->camera = $camera;    
        return $this;
    }

    /**
     * Get camera
     * @return \Gestion\PassBundle\Entity\Camera 
     */
    public function getCamera()
    {
        return $this->camera;
    }       
    }