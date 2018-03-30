<?php

namespace SoukElMedina\PidevBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Promotions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Promotion controller.
 *
 */
class PromotionsController extends Controller
{
    /**
     * Lists all promotion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $promotions = $em->getRepository('SoukElMedinaPidevBundle:Promotions')->findAll();

        return $this->render('promotions/index.html.twig', array(
            'promotions' => $promotions,
        ));
    }

    /**
     * Creates a new promotion entity.
     *
     */
    public function newAction(Request $request)
    {
        $promotion = new Promotion();
        $form = $this->createForm('SoukElMedina\PidevBundle\Form\PromotionsType', $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();

            return $this->redirectToRoute('promotions_show', array('idpromotion' => $promotion->getIdpromotion()));
        }

        return $this->render('promotions/new.html.twig', array(
            'promotion' => $promotion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a promotion entity.
     *
     */
    public function showAction(Promotions $promotion)
    {
        $deleteForm = $this->createDeleteForm($promotion);

        return $this->render('promotions/show.html.twig', array(
            'promotion' => $promotion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing promotion entity.
     *
     */
    public function editAction(Request $request, Promotions $promotion)
    {
        $deleteForm = $this->createDeleteForm($promotion);
        $editForm = $this->createForm('SoukElMedina\PidevBundle\Form\PromotionsType', $promotion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promotions_edit', array('idpromotion' => $promotion->getIdpromotion()));
        }

        return $this->render('promotions/edit.html.twig', array(
            'promotion' => $promotion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a promotion entity.
     *
     */
    public function deleteAction(Request $request, Promotions $promotion)
    {
        $form = $this->createDeleteForm($promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($promotion);
            $em->flush();
        }

        return $this->redirectToRoute('promotions_index');
    }

    /**
     * Creates a form to delete a promotion entity.
     *
     * @param Promotions $promotion The promotion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Promotions $promotion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('promotions_delete', array('idpromotion' => $promotion->getIdpromotion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
