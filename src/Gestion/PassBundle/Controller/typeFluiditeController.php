<?php

namespace Gestion\PassBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\PassBundle\Entity\typeFluidite;
use Gestion\PassBundle\Form\typeFluiditeType;

/**
 * typeFluidite controller.
 *
 */
class typeFluiditeController extends Controller
{

    /**
     * Lists all typeFluidite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionPassBundle:typeFluidite')->findAll();

        return $this->render('GestionPassBundle:typeFluidite:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new typeFluidite entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new typeFluidite();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typefluidite_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionPassBundle:typeFluidite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a typeFluidite entity.
    *
    * @param typeFluidite $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(typeFluidite $entity)
    {
        $form = $this->createForm(new typeFluiditeType(), $entity, array(
            'action' => $this->generateUrl('typefluidite_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new typeFluidite entity.
     *
     */
    public function newAction()
    {
        $entity = new typeFluidite();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionPassBundle:typeFluidite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeFluidite entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:typeFluidite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find typeFluidite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:typeFluidite:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing typeFluidite entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:typeFluidite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find typeFluidite entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:typeFluidite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a typeFluidite entity.
    *
    * @param typeFluidite $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(typeFluidite $entity)
    {
        $form = $this->createForm(new typeFluiditeType(), $entity, array(
            'action' => $this->generateUrl('typefluidite_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing typeFluidite entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:typeFluidite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find typeFluidite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('typefluidite_edit', array('id' => $id)));
        }

        return $this->render('GestionPassBundle:typeFluidite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a typeFluidite entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionPassBundle:typeFluidite')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find typeFluidite entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typefluidite'));
    }

    /**
     * Creates a form to delete a typeFluidite entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typefluidite_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
