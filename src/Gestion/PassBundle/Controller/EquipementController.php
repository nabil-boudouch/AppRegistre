<?php

namespace Gestion\PassBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\PassBundle\Entity\Equipement;
use Gestion\PassBundle\Form\EquipementType;

/**
 * Equipement controller.
 *
 */
class EquipementController extends Controller
{

    /**
     * Lists all Equipement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionPassBundle:Equipement')->findAll();

        return $this->render('GestionPassBundle:Equipement:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Equipement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Equipement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipement_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionPassBundle:Equipement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Equipement entity.
    *
    * @param Equipement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Equipement $entity)
    {
        $form = $this->createForm(new EquipementType(), $entity, array(
            'action' => $this->generateUrl('equipement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Equipement entity.
     *
     */
    public function newAction()
    {
        $entity = new Equipement();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionPassBundle:Equipement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Equipement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Equipement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Equipement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Equipement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Equipement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Equipement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Equipement entity.
    *
    * @param Equipement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Equipement $entity)
    {
        $form = $this->createForm(new EquipementType(), $entity, array(
            'action' => $this->generateUrl('equipement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Equipement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Equipement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('equipement_edit', array('id' => $id)));
        }

        return $this->render('GestionPassBundle:Equipement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Equipement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionPassBundle:Equipement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Equipement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('equipement'));
    }

    /**
     * Creates a form to delete a Equipement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
