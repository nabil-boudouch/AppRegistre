<?php

namespace Gestion\PassBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\PassBundle\Entity\Facilitation;
use Gestion\PassBundle\Form\FacilitationType;
use Gestion\PassBundle\Utils\AppRegistre as AppRegistre;
use Symfony\Component\HttpFoundation\Response;

/**
 * Facilitation controller.
 *
 */
class FacilitationController extends Controller
{

    /**
     * Lists all Facilitation entities.
     *
     */
    public function indexAction($page)
    {
         $em = $this->getDoctrine()->getEntityManager();
         $qb = $em->createQueryBuilder();       
         $total  = $em->getRepository('GestionPassBundle:Facilitation')->findAll();
        /* total of résultat */
        $total_anomalies    = count($total);
        $anomalies_per_page = $this->container->getParameter('max_articles_on_listepage');
        $last_page         = ceil($total_anomalies / $anomalies_per_page);
        $previous_page     = $page > 1 ? $page - 1 : 1;
        $next_page         = $page < $last_page ? $page + 1 : $last_page;       
            /* résultat  à afficher*/        
        $entities   = $qb ->select('a')                
                          ->from('GestionPassBundle:Facilitation', 'a')
                          ->orderBy('a.dateReglement', 'ASC')
                                    ->setFirstResult(($page * $anomalies_per_page) - $anomalies_per_page)
                                    ->setMaxResults($this->container->getParameter('max_articles_on_listepage'))
                                    ->getQuery()->getResult();                            
        return $this->render('GestionPassBundle:Facilitation:index.html.twig', array(
                    'entities' => $entities,
                    'last_page' => $last_page,
                    'previous_page' => $previous_page,
                    'current_page' => $page,
                    'next_page' => $next_page,
                    'total_anomalies' => $total_anomalies,
            ));
    }
    /**
     * Creates a new Facilitation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Facilitation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $dateDetection= new \DateTime('now');
        $entity->setDateDetection($dateDetection);       
        $user = $this->container->get('security.context')->getToken()->getUser();
        $username =$user->getUsername();
        $entity->setUser($username);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('facilitation_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionPassBundle:Facilitation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Facilitation entity.
    *
    * @param Facilitation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Facilitation $entity)
    {
        $form = $this->createForm(new FacilitationType(), $entity, array(
            'action' => $this->generateUrl('facilitation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    /**
     * Displays a form to create a new Facilitation entity.
     *
     */
    public function newAction()
    {
        $entity = new Facilitation();
        $form   = $this->createCreateForm($entity);
        return $this->render('GestionPassBundle:Facilitation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Finds and displays a Facilitation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GestionPassBundle:Facilitation')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facilitation entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('GestionPassBundle:Facilitation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    /**
     * Displays a form to edit an existing Facilitation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GestionPassBundle:Facilitation')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facilitation entity.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('GestionPassBundle:Facilitation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
    * Creates a form to edit a Facilitation entity.
    *
    * @param Facilitation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Facilitation $entity)
    {
        $form = $this->createForm(new FacilitationType(), $entity, array(
            'action' => $this->generateUrl('facilitation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Facilitation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Facilitation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facilitation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('facilitation_edit', array('id' => $id)));
        }

        return $this->render('GestionPassBundle:Facilitation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Facilitation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionPassBundle:Facilitation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facilitation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facilitation'));
    }

    /**
     * Creates a form to delete a Facilitation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facilitation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Delete',
                 'attr' => array(
                    'class' => 'btn btn-danger')
                
                ))
            ->getForm()
        ;
    }

        public function reglerAction($id){
      
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Facilitation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anomalie entity.');
        }
//        $dateDetection= new \DateTime('now');
//        $entity->setDateDetection($dateDetection);       
        $deleteForm = $this->createDeleteForm($id);

        $this->reglerFacilitation($entity);
       // $AnomalieRepository->regleranomalie($entity);
             $em->persist($entity);
             $em->flush();
      return $this->redirect($this->generateUrl('facilitation'));

             
//        return    $this->render('GestionPassBundle:Anomalie:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),        
////            'edit_form'   => $editForm->createView(),
//            ));

    }
     public function reglerFacilitation(Facilitation $facil){
        $facil->setDateReglement(new \DateTime('now'));
        
    }
    public function facilitationsEncoursAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('f')
                ->from('GestionPassBundle:Facilitation', 'f')
                ->where('f.dateReglement IS NULL')
                ->orderBy('f.dateDetection', 'DESC');
        $query = $qb->getQuery();
        $entities = $query->getResult();
        return $this->render("GestionPassBundle:Facilitation:liste.html.twig", array(
                    'entities' => $entities,
        ));
    }
    
        //chart facilitation action
        public function chartFacilitationAction() {

            $nbrFacilitationExpMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Facilitation')
                ->FacilitationParSce('exploitation');

            $nbrFacilitationDGSNMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Facilitation')
                ->FacilitationParSce('DGSN');
    
            
            $resultat = array();

        array_push($resultat, $nbrFacilitationExpMois);
        array_push($resultat, $nbrFacilitationDGSNMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    //afficher chart fluidite
        public function afficherChartFacilitationAction() {

        $response = $this->chartFacilitationAction();
        return $this->render("GestionPassBundle:Facilitation:FacilitationChart.html.twig", array(
                    'response' => $response,
        ));
    }
    //facilitation pie chart
    
    //facilitation pie pourcentage  Return Json Response
    public function chartFacilitationPieAction() {
        $nbrFacilitationDGSNMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Facilitation')
                ->FacilitationPieParSce('DGSN');
        $nbrFacilitationExplMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Facilitation')
                ->FacilitationPieParSce('exploitation');
        $total = $nbrFacilitationDGSNMois[1] + $nbrFacilitationExplMois[1] ;
        $prcDGSN = AppRegistre::Pourcentage($nbrFacilitationDGSNMois[1], $total);
        $prcExpl = AppRegistre::Pourcentage($nbrFacilitationExplMois[1], $total);

        $nbrFacilitationDGSNMois[1] = $prcDGSN;
        $nbrFacilitationExplMois[1] = $prcExpl;

        $resultat = array();
        array_push($resultat, $nbrFacilitationExplMois);
        array_push($resultat, $nbrFacilitationDGSNMois);
       
        $response = new Response(json_encode($resultat, JSON_NUMERIC_CHECK));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

//Afficher Chart Pie 
    public function afficherChartFacilitationPieAction() {
        $response = $this->chartFacilitationPieAction();
        return $this->render("GestionPassBundle:Facilitation:ChartFacilitationPie.html.twig", array(
                    'response' => $response,
        ));
    }
   
    //Fluidite par heure 
    //
public function chartFacilitationHeureAction() {
        $nbrFacilitationDGSNMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Facilitation')
                ->FacilitationParSce('DGSN');

        $resultat = array();

        array_push($resultat, $nbrFacilitationDGSNMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartFacilitationHeureAction() {

        $response = $this->chartFluiditeAction();
        return $this->render("GestionPassBundle:Facilitation:FacilitationChartHeure.html.twig", array(
                    'response' => $response,
        ));
    }

    //fluidité du service exploitation 
    
    public function chartFacilExploitationAction() {
        $nbrFacilExplMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Facilitation')
                ->FacilitationParSce('exploitation');
        $resultat = array();

        array_push($resultat, $nbrFacilExplMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartFacilExplAction() {

        $response = $this->chartFacilExploitationAction();
        return $this->render("GestionPassBundle:Facilitation:ChartExploitation.html.twig", array(
                    'response' => $response,
        ));
    } 

    
    }
