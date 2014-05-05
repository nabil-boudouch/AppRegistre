<?php

namespace Gestion\PassBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\PassBundle\Entity\Exportation;
use Gestion\PassBundle\Entity\CameraRange;
use Gestion\PassBundle\Form\ExportationType;

/**
 * Exportation controller.
 *
 */
class ExportationController extends Controller
{

 
    /**
     * Lists all Exportation entities.
     *
     */

        public static $compt=1 ;
        
public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionPassBundle:Exportation')->findAll();

        return $this->render('GestionPassBundle:Exportation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Exportation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Exportation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $user = $this->container->get('security.context')->getToken()->getUser();
        $username = $user->getUsername();
        $entity->setUser($username);

        $dateSaisie = new \DateTime('now');
        $entity->setDateSaisie($dateSaisie);
        
        //le code de l'exportation est geré automatiquement par une variable unique 
       
        $entity->setCodeExport('Exp'. self::$compt);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('exportation'));
        }
        return $this->render('GestionPassBundle:Exportation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Exportation entity.
    *
    * @param Exportation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Exportation $entity)
    {
        $form = $this->createForm(new ExportationType(), $entity, array(
            'action' => $this->generateUrl('exportation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Exportation entity.
     *
     */
    public function newAction()
    {
        $entity = new Exportation();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionPassBundle:Exportation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Exportation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Exportation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exportation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Exportation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Exportation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Exportation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exportation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionPassBundle:Exportation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Exportation entity.
    *
    * @param Exportation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Exportation $entity)
    {
        $form = $this->createForm(new ExportationType(), $entity, array(
            'action' => $this->generateUrl('exportation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Exportation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionPassBundle:Exportation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exportation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('exportation_edit', array('id' => $id)));
        }

        return $this->render('GestionPassBundle:Exportation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Exportation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionPassBundle:Exportation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Exportation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('exportation'));
    }

    /**
     * Creates a form to delete a Exportation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('exportation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
