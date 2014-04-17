<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gestion\PassBundle\Entity\CameraRange;
/**
 * Exportation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\ExportationRepository")
 */
class Exportation
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
     * @ORM\Column(name="codeExport", type="string", length=255)
     */
    private $codeExport;
    /**
   * @ORM\ManyToMany(targetEntity="Gestion\PassBundle\Entity\CameraRange", cascade={"persist"})
   */
    private $cameraRanges;

    public function __construct()
    {
        $this->cameraRanges = new ArrayCollection();
    }
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
     * Set codeExport
     *
     * @param string $codeExport
     * @return Exportation
     */
    public function setCodeExport($codeExport)
    {
        $this->codeExport = $codeExport;
    
        return $this;
    }

    /**
     * Get codeExport
     *
     * @return string 
     */
    public function getCodeExport()
    {
        return $this->codeExport;
    }

     public function __toString(){
        return strval($this->getCodeExport());
        
    }
    
    /**
     * Add cameraRanges
     *
     * @param \Gestion\PassBundle\Entity\CameraRange $cameraRanges
     * @return Exportation
     */
    public function addCameraRange(\Gestion\PassBundle\Entity\CameraRange $cameraRange)
    {
        $this->cameraRanges[] = $cameraRange;
    
        return $this;
    }

    /**
     * Remove cameraRanges
     *
     * @param \Gestion\PassBundle\Entity\CameraRange $cameraRanges
     */
    public function removeCameraRange(\Gestion\PassBundle\Entity\CameraRange $cameraRange)
    {
        $this->cameraRanges->removeElement($cameraRange);
    }

    /**
     * Get cameraRanges
     *
     * @return Collection 
     */
    public function getCameraRanges()
    {
        return $this->cameraRanges;
    }
}