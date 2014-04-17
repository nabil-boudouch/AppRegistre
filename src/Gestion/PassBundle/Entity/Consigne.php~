<?php

namespace Gestion\PassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consigne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\PassBundle\Entity\ConsigneRepository")
 */
class Consigne
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
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateConsigne", type="datetime")
     */ 
    private $dateConsigne;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set objet
     *
     * @param string $objet
     * @return Consigne
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

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Consigne
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Consigne
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
     * Set dateConsigne
     *
     * @param \DateTime $dateConsigne
     * @return Consigne
     */
    public function setDateConsigne($dateConsigne)
    {
        $this->dateConsigne = $dateConsigne;
    
        return $this;
    }

    /**
     * Get dateConsigne
     *
     * @return \DateTime 
     */
    public function getDateConsigne()
    {
        return $this->dateConsigne;
    }

public function __toString(){
        return strval($this->getObjet());
        
    }
    
}