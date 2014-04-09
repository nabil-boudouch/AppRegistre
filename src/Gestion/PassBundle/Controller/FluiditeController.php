<?php

namespace Gestion\PassBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\PassBundle\Entity\Fluidite;
use Gestion\PassBundle\Form\FluiditeType;

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
    public function indexAction()
   {
        $em = $this->getDoctrine()->getManager();

          $qb = $em->createQueryBuilder();
          $qb->select('f')
                ->from('GestionPassBundle:Fluidite', 'f')
                ->orderBy('f.dateReglement', 'ASC');
                
        $query = $qb->getQuery();
        $entities = $query->getResult();
        //
        return $this->render('GestionPassBundle:Fluidite:index.html.twig', array(
            'entities' => $entities,
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
        $dateDetection= new \DateTime('now');
        $entity->setDateDetection($dateDetection);
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        $username =$user->getUsername();
        $entity->setUser($username);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fluidite_show', array('id' => $entity->getId())));
        }

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
    * @return \Symfony\Component\Form\Form The form
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
    * @return \Symfony\Component\Form\Form The form
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
     * @return \Symfony\Component\Form\Form The form
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
        $fluid->setDateReglement(new \DateTime('now'));
        
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
    }
