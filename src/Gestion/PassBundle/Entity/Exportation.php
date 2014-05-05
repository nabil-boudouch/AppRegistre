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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="codeExport", type="string", length=255)
     */
    private $codeExport;
        
    /**
     * @var string
     *
     * @ORM\Column(name="beneficiaire", type="string", length=255)
     */
    private $beneficiaire;
    
     /**
     * @var string
     *
     * @ORM\Column(name="organisme", type="string", length=255)
     */
    private $organisme;
    
     /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=255, nullable=true)
     */
    private $objet;
    
    
    /**
   * @ORM\ManyToMany(targetEntity="Gestion\PassBundle\Entity\CameraRange", cascade={"persist"})
   */
    private $cameraRanges;

    
     /**
     * @var \String
     *
     * @ORM\Column(name="user", type="string")
     */
    private $user;
      
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSaisie", type="datetime")
     */
    private $dateSaisie;
    
//    public static function increment() 
//        {
//     return self::$compteur++;
//  }
    
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

    /**
     * Set user
     *
     * @param string $user
     * @return Exportation
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

    /**
     * Set dateSaisie
     *
     * @param \DateTime $dateSaisie
     * @return Exportation
     */
    public function setDateSaisie($dateSaisie)
    {
        $this->dateSaisie = $dateSaisie;
    
        return $this;
    }

    /**
     * Get dateSaisie
     *
     * @return \DateTime 
     */
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }

    /**
     * Set beneficiaire
     *
     * @param string $beneficiaire
     * @return Exportation
     */
    public function setBeneficiaire($beneficiaire)
    {
        $this->beneficiaire = $beneficiaire;
    
        return $this;
    }

    /**
     * Get beneficiaire
     *
     * @return string 
     */
    public function getBeneficiaire()
    {
        return $this->beneficiaire;
    }

    /**
     * Set organisme
     *
     * @param string $organisme
     * @return Exportation
     */
    public function setOrganisme($organisme)
    {
        $this->organisme = $organisme;
    
        return $this;
    }

    /**
     * Get organisme
     *
     * @return string 
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * Set objet
     *
     * @param string $objet
     * @return Exportation
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    
        return $this;
    }

    /**
     * Get objet
     *
     * @return string 
     */
    public function getObjet()
    {
        return $this->objet;
    }
}