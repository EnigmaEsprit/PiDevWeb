<?php

namespace SoukElMedina\PidevBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Magasins;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Magasin controller.
 *
 */
class MagasinsController extends Controller
{
    /**
     * Lists all magasin entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $magasins = $em->getRepository('SoukElMedinaPidevBundle:Magasins')->findAll();

        return $this->render('magasins/index2.html.twig', array(
            'magasins' => $magasins,
        ));
    }

    /**
     * Creates a new magasin entity.
     *
     */
    public function newAction(Request $request)
    {
        $magasin = new Magasins();
        $form = $this->createForm('SoukElMedina\PidevBundle\Form\MagasinsType', $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($magasin);
            $em->flush();

            return $this->redirectToRoute('magasins_show', array('idmagasin' => $magasin->getIdmagasin()));
        }

        return $this->render('magasins/new.html.twig', array(
            'magasin' => $magasin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a magasin entity.
     *
     */
    public function showAction(Magasins $magasin)
    {
        $deleteForm = $this->createDeleteForm($magasin);

        return $this->render('magasins/show.html.twig', array(
            'magasin' => $magasin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing magasin entity.
     *
     */
    public function editAction(Request $request, Magasins $magasin)
    {
        $deleteForm = $this->createDeleteForm($magasin);
        $editForm = $this->createForm('SoukElMedina\PidevBundle\Form\MagasinsType', $magasin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magasins_edit', array('idmagasin' => $magasin->getIdmagasin()));
        }

        return $this->render('magasins/edit.html.twig', array(
            'magasin' => $magasin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a magasin entity.
     *
     */
    public function deleteAction(Request $request, Magasins $magasin)
    {
        $form = $this->createDeleteForm($magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($magasin);
            $em->flush();
        }

        return $this->redirectToRoute('magasins_index');
    }

    /**
     * Creates a form to delete a magasin entity.
     *
     * @param Magasins $magasin The magasin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Magasins $magasin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('magasins_delete', array('idmagasin' => $magasin->getIdmagasin())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
