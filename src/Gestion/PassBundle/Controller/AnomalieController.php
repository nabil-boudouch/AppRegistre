<?php

namespace Gestion\PassBundle\Controller;

use DateTime;
use Gestion\PassBundle\Entity\Anomalie;
use Gestion\PassBundle\Form\AnomalieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Anomalie controller.
 *
 */
class AnomalieController extends Controller {

    /**
     * Lists all Anomalie entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('a')
                ->from('GestionPassBundle:Anomalie', 'a')
                ->orderBy('a.dateReglement', 'ASC');
        $query = $qb->getQuery();
        $entities = $query->getResult();

        return $this->render('GestionPassBundle:Anomalie:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Anomalie entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Anomalie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $dateDetection = new DateTime('now');

        $user = $this->container->get('security.context')->getToken()->getUser();
        $username = $user->getUsername();
        $entity->setUser($username);

        $entity->setDateDetection($dateDetection);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('anomalie'));
        }

        return $this->render('GestionPassBundle:Anomalie:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Anomalie entity.
     *
     * @param Anomalie $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Anomalie $entity) {
        $form = $this->createForm(new AnomalieType(), $entity, array(
            'action' => $this->generateUrl('anomalie_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Anomalie entity.
     *
     */
    public function newAction() {
        $entity = new Anomalie();
        $form = $this->createCreateForm($entity);

        return $this->render('GestionPassBundle:Anomalie:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Anomalie entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Anomalie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anomalie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Anomalie:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Anomalie entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Anomalie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anomalie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Anomalie:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Anomalie entity.
     *
     * @param Anomalie $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Anomalie $entity) {
        $form = $this->createForm(new AnomalieType(), $entity, array(
            'action' => $this->generateUrl('anomalie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Anomalie entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Anomalie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anomalie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('anomalie_edit', array('id' => $id)));
        }

        return $this->render('GestionPassBundle:Anomalie:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Anomalie entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionPassBundle:Anomalie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Anomalie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('anomalie'));
    }

    /**
     * Creates a form to delete a Anomalie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('anomalie_delete', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => 'Delete',
                            'attr' => array(
                                'class' => 'btn btn-danger')
                        ))
                        ->getForm()
        ;
    }

    public function reglerAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Anomalie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anomalie entity.');
        }
//        $dateDetection= new \DateTime('now');
//        $entity->setDateDetection($dateDetection);       
        $deleteForm = $this->createDeleteForm($id);

        $this->reglerAnomalie($entity);
        // $AnomalieRepository->regleranomalie($entity);
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('anomalie'));


//        return    $this->render('GestionPassBundle:Anomalie:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),        
////            'edit_form'   => $editForm->createView(),
//            ));
    }

    public function AjaxReglerAction($id) {

        $request = $this->get('request');
        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Anomalie')->find($id);

        if ($request->isXmlHttpRequest()) {
            $this->reglerAnomalie($entity);
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('anomalie'));
            return $response;
        }
        return $response;
    }

    public function anomaliesEncoursAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('a')
                ->from('GestionPassBundle:Anomalie', 'a')
                ->where('a.dateReglement IS NULL')
                ->orderBy('a.dateDetection', 'ASC');

        $query = $qb->getQuery();
        $entities = $query->getResult();
        return $this->render("GestionPassBundle:Anomalie:liste.html.twig", array(
                    'entities' => $entities,
        ));
    }

    public function reglerAnomalie(Anomalie $ano) {
        $ano->setDateReglement(new \DateTime('now'));
    }

    public function chartAnomalieAction() {
        $nbrAnomalieInformatiqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesParSce('informatique');

        $nbrAnomalieElectroniqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesParSce('electronique');

        $nbrAnomalieElectriqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesParSce('Electrique');
        $resultat = array();

        array_push($resultat, $nbrAnomalieInformatiqueMois);
        array_push($resultat, $nbrAnomalieElectroniqueMois);
        array_push($resultat, $nbrAnomalieElectriqueMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartAction() {

        $response = $this->chartAnomalieAction();
        return $this->render("GestionPassBundle:Anomalie:AnomalieChart.html.twig", array(
                    'response' => $response,
        ));
    }

    public function chartAnoInfoAction() {

        $nbrAnomalieInformatiqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesParSce('informatique');
        $resultat = array();

        array_push($resultat, $nbrAnomalieInformatiqueMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartInfoAction() {

        $response = $this->chartAnoInfoAction();
        return $this->render("GestionPassBundle:Anomalie:ChartInformatique.html.twig", array(
                    'response' => $response,
        ));
    }

    public function chartAnoElectroAction() {

        $nbrAnomalieElectroMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesParSce('Electronique');
        $resultat = array();

        array_push($resultat, $nbrAnomalieElectroMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartElectroAction() {
        $response = $this->chartAnoElectroAction();
        return $this->render("GestionPassBundle:Anomalie:ChartElectronique.html.twig", array(
                    'response' => $response,
        ));
    }

    public function chartAnoElecAction() {

        $nbrAnomalieElecMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesParSce('Electrique');
        $resultat = array();

        array_push($resultat, $nbrAnomalieElecMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartElecAction() {
        $response = $this->chartAnoElectroAction();
        return $this->render("GestionPassBundle:Anomalie:ChartElectrique.html.twig", array(
                    'response' => $response,
        ));
    }

//anomalie par heure
    public function chartAnomalieHeureAction() {
        $nbrAnomalieInformatiqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesParSce('informatique');

        $resultat = array();

        array_push($resultat, $nbrAnomalieInformatiqueMois);

        $response = new Response(json_encode($resultat));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function afficherChartHeureAction() {

        $response = $this->chartAnomalieAction();
        return $this->render("GestionPassBundle:Anomalie:AnomalieChartHeure.html.twig", array(
                    'response' => $response,
        ));
    }

//anomalie pie pourcentage  Return Json Response
    public function chartAnomaliePieAction() {

        $nbrAnomalieInformatiqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesPieParSce('informatique');
        $nbrAnomalieElectroniqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesPieParSce('electronique');

        $nbrAnomalieElectriqueMois = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->AnomaliesPieParSce('Electrique');

        $total = $nbrAnomalieElectriqueMois[1] + $nbrAnomalieElectroniqueMois[1] + $nbrAnomalieInformatiqueMois[1];
        $prcInfo = $this->Pourcentage($nbrAnomalieInformatiqueMois[1], $total);
        $prcElec = $this->Pourcentage($nbrAnomalieElectriqueMois[1], $total);
        $prcElectro = $this->Pourcentage($nbrAnomalieElectroniqueMois[1], $total);

        $nbrAnomalieElectriqueMois[1] = $prcElec;
        $nbrAnomalieElectroniqueMois[1] = $prcElectro;
        $nbrAnomalieInformatiqueMois[1] = $prcInfo;

        $resultat = array();
        array_push($resultat, $nbrAnomalieInformatiqueMois);
        array_push($resultat, $nbrAnomalieElectroniqueMois);
        array_push($resultat, $nbrAnomalieElectriqueMois);

        $response = new Response(json_encode($resultat, JSON_NUMERIC_CHECK));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

//Afficher Chart Pie 
    public function afficherChartPieAction() {
        $response = $this->chartAnomaliePieAction();
        return $this->render("GestionPassBundle:Anomalie:ChartPie.html.twig", array(
                    'response' => $response,
        ));
    }

//fonction pourcentage
    function Pourcentage($Nombre, $Total) {

        $resultat = $Nombre * 100 / $Total;
        return number_format($resultat, 2,'.','');
    }
//
    public function nbrAnoAction(){
                 $nbrAnomalies = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('GestionPassBundle:Anomalie')
                ->nbrAnomaliesEncours();
                 return $nbrAnomalies;
    }
    
    }
