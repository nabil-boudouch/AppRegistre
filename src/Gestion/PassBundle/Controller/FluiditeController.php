<?php

namespace Gestion\PassBundle\Controller;

use DateTime;
use Gestion\PassBundle\Entity\Fluidite;
use Gestion\PassBundle\Form\FluiditeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Gestion\PassBundle\Utils\AppRegistre as AppRegistre;

/**
 * Fluidite controller.
 *
 */
class FluiditeController extends Controller
{

    /**
     * Lists all Fluidite entities.
     *
     */
    public function indexAction($page)
   {
 $em = $this->getDoctrine()->getEntityManager();
         $qb = $em->createQueryBuilder();       
         $total  = $em->getRepository('GestionPassBundle:Fluidite')->findAll();
        /* total of résultat */
        $total_anomalies    = count($total);
        $anomalies_per_page = $this->container->getParameter('max_articles_on_listepage');
        $last_page         = ceil($total_anomalies / $anomalies_per_page);
        $previous_page     = $page > 1 ? $page - 1 : 1;
        $next_page         = $page < $last_page ? $page + 1 : $last_page;       
            /* résultat  à afficher*/        
        $entities   = $qb ->select('a')                
                          ->from('GestionPassBundle:Fluidite', 'a')
                          ->orderBy('a.dateReglement', 'ASC')
                                    ->setFirstResult(($page * $anomalies_per_page) - $anomalies_per_page)
                                    ->setMaxResults($this->container->getParameter('max_articles_on_listepage'))
                                    ->getQuery()->getResult();                            
        return $this->render('GestionPassBundle:Fluidite:index.html.twig', array(
                    'entities' => $entities,
                    'last_page' => $last_page,
                    'previous_page' => $previous_page,
                    'current_page' => $page,
                    'next_page' => $next_page,
                    'total_anomalies' => $total_anomalies,
            ));
    }
    /**
     * Creates a new Fluidite entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Fluidite();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $dateDetection= new DateTime('now');
        $entity->setDateDetection($dateDetection);
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        $username =$user->getUsername();
        $entity->setUser($username);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

       return $this->redirect($this->generateUrl('fluidite'));        }

        return $this->render('GestionPassBundle:Fluidite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Fluidite entity.
    *
    * @param Fluidite $entity The entity
    *
    * @return Form The form
    */
    private function createCreateForm(Fluidite $entity)
    {
        $form = $this->createForm(new FluiditeType(), $entity, array(
            'action' => $this->generateUrl('fluidite_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Fluidite entity.
     *
     */
    public function newAction()
    {
        $entity = new Fluidite();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionPassBundle:Fluidite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fluidite entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Fluidite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fluidite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Fluidite:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Fluidite entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Fluidite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fluidite entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Fluidite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Fluidite entity.
    *
    * @param Fluidite $entity The entity
    *
    * @return Form The form
    */
    private function createEditForm(Fluidite $entity)
    {
        $form = $this->createForm(new FluiditeType(), $entity, array(
            'action' => $this->generateUrl('fluidite_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Update',
             'attr' => array(
                    'class' => 'btn ')
                
            ));

        return $form;
    }
    /**
     * Edits an existing Fluidite entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Fluidite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fluidite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fluidite_edit', array('id' => $id)));
        }

        return $this->render('GestionPassBundle:Fluidite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Fluidite entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionPassBundle:Fluidite')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fluidite entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fluidite'));
    }

    /**
     * Creates a form to delete a Fluidite entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fluidite_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Delete',
                'attr' => array(
                    'class' => 'btn btn-danger'
                ))
                    
                )
                
                 
            ->getForm()
        ;
    }
        public function reglerAction($id){
      
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Fluidite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find fluidite entity.');
        }
//        $dateDetection= new \DateTime('now');
//        $entity->setDateDetection($dateDetection);       
        $deleteForm = $this->createDeleteForm($id);

        $this->reglerFluidite($entity);
       // $AnomalieRepository->regleranomalie($entity);
             $em->persist($entity);
             $em->flush();
      return $this->redirect($this->generateUrl('fluidite'));

             
//        return    $this->render('GestionPassBundle:Anomalie:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),        
////            'edit_form'   => $editForm->createView(),
//            ));

    }
    
public function reglerFluidite(Fluidite $fluid){
        $fluid->setDateReglement(new DateTime('now'));
        
    }
    
    public function fluiditesEncoursAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('f')
                ->from('GestionPassBundle:Fluidite', 'f')
                ->where('f.dateReglement IS NULL')
                ->orderBy('f.dateDetection', 'DESC');
        $query = $qb->getQuery();
        $entities = $query->getResult();
        return $this->render("GestionPassBundle:Fluidite:liste.html.twig", array(
                    'entities' => $entities,
        ));
    } 
 
    //chart fluidite action
        public function chartFluiditeAction() {

            $nbrFluiditeDGSNMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Fluidite')
                ->FluiditeParSce('dgsn');

            $nbrFluiditeExplMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Fluidite')
                ->FluiditeParSce('exploitation');
    
            
            $resultat = array();

        array_push($resultat, $nbrFluiditeDGSNMois);
        array_push($resultat, $nbrFluiditeExplMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    //afficher chart fluidite
        public function afficherChartFluiditeAction() {

        $response = $this->chartFluiditeAction();
        return $this->render("GestionPassBundle:Fluidite:FluiditeChart.html.twig", array(
                    'response' => $response,
        ));
    }
    
    //fluidite pie chart
    
    //anomalie pie pourcentage  Return Json Response
    public function chartFluiditePieAction() {

        $nbrFluiditeDGSNMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Fluidite')
                ->fluiditesPieParSce('DGSN');
        $nbrFluiditeExplMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Fluidite')
                ->fluiditesPieParSce('exploitation');

        $total = $nbrFluiditeDGSNMois[1] + $nbrFluiditeExplMois[1] ;
      
        $prcDGSN = AppRegistre::Pourcentage($nbrFluiditeDGSNMois[1], $total);
        $prcExpl = AppRegistre::Pourcentage($nbrFluiditeExplMois[1], $total);

        $nbrFluiditeDGSNMois[1] = $prcDGSN;
        $nbrFluiditeExplMois[1] = $prcExpl;

        $resultat = array();
        array_push($resultat, $nbrFluiditeExplMois);
        array_push($resultat, $nbrFluiditeDGSNMois);
       
        $response = new Response(json_encode($resultat, JSON_NUMERIC_CHECK));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

//Afficher Chart Pie 
    public function afficherChartFluiditePieAction() {
        $response = $this->chartFluiditePieAction();
        return $this->render("GestionPassBundle:Fluidite:ChartFluiditePie.html.twig", array(
                    'response' => $response,
        ));
    }
   
    //Fluidite par heure 
    //
public function chartFluiditeHeureAction() {
        $nbrFluiditeDGSNMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Fluidite')
                ->FluiditeParSce('DGSN');

        $resultat = array();

        array_push($resultat, $nbrFluiditeDGSNMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartFluiditeHeureAction() {

        $response = $this->chartFluiditeAction();
        return $this->render("GestionPassBundle:Fluidite:FluiditeChartHeure.html.twig", array(
                    'response' => $response,
        ));
    }

    //fluidité du service exploitation 
    
    public function chartFluExploitationAction() {
        $nbrFluExplMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Fluidite')
                ->FluiditeParSce('exploitation');
        $resultat = array();

        array_push($resultat, $nbrFluExplMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartFluExplAction() {

        $response = $this->chartFluExploitationAction();
        return $this->render("GestionPassBundle:Fluidite:ChartExploitation.html.twig", array(
                    'response' => $response,
        ));
    } 
    }
