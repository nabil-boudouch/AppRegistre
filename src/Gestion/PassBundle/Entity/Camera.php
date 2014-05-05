<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Camera
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\CameraRepository")
 */
class Camera
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
     * @ORM\Column(name="nomCamera", type="string", length=100)
     */

    private $nomCamera;
   
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
     * Set nomCamera
     *
     * @param string $nomCamera
     * @return Camera
     */
    public function setNomCamera($nomCamera)
    {
        $this->nomCamera = $nomCamera;
    
        return $this;
    }
    /**
     * Get nomCamera
     *
     * @return string 
     */
    public function getNomCamera()
    {
        return $this->nomCamera;
    }
 public function __toString(){
        return strval($this->getId());
        
    }
    
    
 
}