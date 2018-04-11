<?php

namespace SoukElMedina\PidevBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Magasins;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Magasin controller.
 *
 * @Route("magasins")
 */
class MagasinsController extends Controller
{
    /**
     * Lists all magasin entities.
     *
     * @Route("/", name="magasins_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $magasins = $em->getRepository('SoukElMedinaPidevBundle:Magasins')->findAll();

        return $this->render('SoukElMedinaPidevBundle:magasins:index.html.twig', array(
            'magasins' => $magasins,
        ));
    }

    /**
     * Creates a new magasin entity.
     *
     * @Route("/new", name="magasins_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $magasin = new Magasins();
        $form = $this->createForm('SoukElMedina\PidevBundle\Form\MagasinsType', $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //  $magasin->uploadPicture();

            $em->persist($magasin);
            $em->flush();

            return $this->redirectToRoute('magasins_index');
        }

        return $this->render('SoukElMedinaPidevBundle:magasins:new.html.twig', array(
            'magasin' => $magasin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a magasin entity.
     *
     * @Route("/{idmagasin}", name="magasins_show")
     * @Method("GET")
     */
    public function showAction(Magasins $magasin)
    {
        $deleteForm = $this->createDeleteForm($magasin);

        return $this->render('SoukElMedinaPidevBundle:magasins:show.html.twig', array(
            'form' => $magasin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing magasin entity.
     *
     * @Route("/{idmagasin}/edit", name="magasins_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Magasins $magasin)
    {
        $deleteForm = $this->createDeleteForm($magasin);
        $editForm = $this->createForm('SoukElMedina\PidevBundle\Form\MagasinsType', $magasin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magasins_index');
        }

        return $this->render('SoukElMedinaPidevBundle:magasins:edit.html.twig', array(
            'magasin' => $magasin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a magasin entity.
     *
     * @Route("/{idmagasin}", name="magasins_delete")
     */
    public function deleteAction($idmagasin)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $Magasin = $EM->getRepository("SoukElMedinaPidevBundle:Magasins")->find($idmagasin);
        $EM->remove($Magasin);
        $EM->flush();
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
