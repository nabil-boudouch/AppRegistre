<?php
namespace Gestion\PassBundle\Generic;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;  
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\FormFactory;

class Generix {

      /**
        * @var Symfony\Bundle\DoctrineBundle\Registry
        */
    protected $doctrine;
    
    public function __construct(Registry $doctrine){        
        $this->doctrine = $doctrine;        
    }
    public function index($persistentObjectName){
    $em = $this->doctrine->getManager();
            $qb = $em->createQueryBuilder();
            $qb->select('a')
                    ->from($persistentObjectName, 'a')
                    ->orderBy('a.dateReglement', 'ASC');
            $query = $qb->getQuery();
            $entities = $query->getResult();        
            return $entities;
    }
    
//    public function create(Request $request,$entity,$route){
//                    
//        $entity =  new \stdClass();        
//        $form = $this->createCreate($entity);
//        $form->handleRequest($request);
//        $dateDetection = new DateTime('now');
//        $user = $this->container->get('security.context')->getToken()->getUser();
//        $username = $user->getUsername();
//        $entity->setUser($username);
//        $entity->setDateDetection($dateDetection);
//
//        if ($form->isValid()) {
//            $em = $this->doctrine->getManager();
//            $em->persist($entity);
//            $em->flush();
//    }
//             return new RedirectResponse($this->container->get('router')->generateUrl($route)); 
//            
//        }
//         
    
    
        public function createCreate($entity,$url){ 

            $entityType= new entityType();
            $urlGenere = $this->container->get('router')->generateUrl($url);
            $form= $this->container->get('form.factory')->createForm(new $entityType(),$entity,array(   
                 'action' => $urlGenere,
                 'method' => 'POST',
        ));       
       
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;  
        }

        
    
        
        }