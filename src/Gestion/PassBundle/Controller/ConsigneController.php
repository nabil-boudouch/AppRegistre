<?php

namespace Gestion\PassBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\PassBundle\Entity\Consigne;
use Gestion\PassBundle\Form\ConsigneType;

/**
 * Consigne controller.
 *
 */
class ConsigneController extends Controller
{

    /**
     * Lists all Consigne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionPassBundle:Consigne')->findAll();

        return $this->render('GestionPassBundle:Consigne:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Consigne entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Consigne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $dateConsigne = new \DateTime('now');
        $entity->setDateConsigne($dateConsigne);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $username = $user->getUsername();
        $entity->setUser($username);
        
       
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('consigne'));
        }

        return $this->render('GestionPassBundle:Consigne:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Consigne entity.
    *
    * @param Consigne $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Consigne $entity)
    {
        $form = $this->createForm(new ConsigneType(), $entity, array(
            'action' => $this->generateUrl('consigne_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Consigne entity.
     *
     */
    public function newAction()
    {
        $entity = new Consigne();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionPassBundle:Consigne:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Consigne entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Consigne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consigne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Consigne:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Consigne entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GestionPassBundle:Consigne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consigne entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        $id=$entity->getId();
        return $this->render('GestionPassBundle:Consigne:edit.html.twig', array(
            'id'        =>$id,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Consigne entity.
    *
    * @param Consigne $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Consigne $entity)
    {
        $form = $this->createForm(new ConsigneType(), $entity, array(
            'action' => $this->generateUrl('consigne_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Consigne entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Consigne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consigne entity.');
        }
        $dateConsigne = new \DateTime('now');
        $entity->setDateConsigne($dateConsigne);

        $id=$entity->getId();

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
       
        if ($editForm->isValid()) {
            $em->flush();
//            return $this->redirect($this->generateUrl('consigne'));
         return $this->redirect($this->generateUrl('consigne'));
            
            
        }

        return $this->render('GestionPassBundle:Consigne:edit.html.twig', array(
            'id'        =>$id,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Consigne entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionPassBundle:Consigne')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Consigne entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('consigne'));
    }

    /**
     * Creates a form to delete a Consigne entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('consigne_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
