<?php

namespace Gestion\PassBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
    public function indexAction()
    {
       return $this->render('GestionPassBundle:Default:index.html.twig');
    
   }    
public function toutesAnomaliesAction(){
       return $this->render('GestionPassBundle:Default:AnomalieEnCours.html.twig');
    
}
public function nbrTotaleAnoAction(){
    
    $em=$this->getDoctrine()->getEntityManager();
    $totAno=$em->getRepository('GestionPassBundle:Anomalie')->nbrAnomaliesEncours();
    $totFacil=$em->getRepository('GestionPassBundle:Facilitation')->nbrFacilitationEncours();
    $totFluid=$em->getRepository('GestionPassBundle:Fluidite')->nbrFluiditeEncours();
       
    $total=$totAno +$totFacil + $totFluid ;
    
    
         return new Response($total);
}
public function nbrTotaleConsigneAction(){
    
    $em=$this->getDoctrine()->getEntityManager();
    $totNote=$em->getRepository('GestionPassBundle:Consigne')->nbrConsigne();
         
         return new Response($totNote);
}
}
