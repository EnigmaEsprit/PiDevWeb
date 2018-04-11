<?php

namespace SoukElMedina\EvenementBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Evenements;
use SoukElMedina\PidevBundle\Entity\Participations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Evenement controller.
 *
 */
class EvenementsController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('iduser' => $this->getUser()->getId()));

        return $this->render('@SoukElMedinaEvenement/evenements/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }

    public function indexEventClientAction()
    {
//        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();


        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findAll();

        return $this->render('@SoukElMedinaEvenement/evenements/indexEventClient.html.twig', array(
            'evenements' => $evenements
        ));
    }

    /**
     * Creates a new evenement entity.
     *
     */

    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $evenement = new Evenements();
        $form = $this->createForm('SoukElMedina\EvenementBundle\Form\EvenementsType', $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $evenement->setIduser($this->getUser());
            $evenement->setLieu($request->get('lieu'));
            $evenement->setDescriptionevenement($request->get('description'));
            $evenement->setDate($request->get('date-start'));
            $evenement->setDateFin($request->get('date-end'));
            $em->persist($evenement);
            $em->flush();
            // var_dump(setFile());

            return $this->redirectToRoute('evenements_index');
        }

        return $this->render('@SoukElMedinaEvenement/evenements/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }
    /**
     * //     * Finds and displays a evenement entity.
     * //     *
     * //     */
//    public function showAction(Evenements $evenement)
//    {
//        $deleteForm = $this->createDeleteForm($evenement);
//
//        return $this->render('@SoukElMedinaEvenement/evenements/show.html.twig', array(
//            'evenement' => $evenement,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    public function showAction(Evenements $evenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
//        $time = new \DateTime();
//        $time->format('Y-m-d');
        $DC = (new \DateTime('now'))->format("d/m/Y H:i");
        var_dump($DC);

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);

        return $this->render('SoukElMedinaEvenementBundle:evenements:show.html.twig', array(
            'evenement' => $evenement, 'evenements' => $evenements
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     */
    public function editAction(Request $request, Evenements $evenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('SoukElMedina\EvenementBundle\Form\EvenementsType', $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $evenement->setLieu($request->get('lieu'));
            $evenement->setDescriptionevenement($request->get('description'));
            $evenement->setDate($request->get('date-start'));
            $evenement->setDateFin($request->get('date-end'));
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenements_index', array('id' => $evenement->getId()));
        }

        return $this->render('@SoukElMedinaEvenement/evenements/edit.html.twig', array(
            'evenement' => $evenement,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($idevenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $Evenement = $EM->getRepository("SoukElMedinaPidevBundle:Evenements")->find($idevenement);
        $EM->remove($Evenement);
        $EM->flush();
        return $this->redirectToRoute('evenements_index');
    }

//    /**
//     * Deletes a evenement entity.
//     *
//     */
//    public function deleteAction(Request $request, Evenements $evenement)
//    {
//        $form = $this->createDeleteForm($evenement);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($evenement);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('evenements_index');
//    }
//
//    /**
//     * Creates a form to delete a evenement entity.
//     *
//     * @param Evenements $evenement The evenement entity
//     *
////     * @return \Symfony\Component\Form\Form The form
//     */
    private function createDeleteForm(Evenements $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenements_delete', array('idevenement' => $evenement->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


    public function affichermapAction($long, $lat)
    {

        return $this->render('@SoukElMedinaEvenement/evenements/map.html.twig', array('long' => $long, 'lat' => $lat));
    }

    public function subscribePageAction()
    {
        return $this->render('@SoukElMedinaEvenement/evenements/participation.html.twig');
    }

    public function subscribeAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $event = $request->get('idevenement');
        $user = $this->getUser();
        $Participent = $EM->getRepository("SoukElMedinaPidevBundle:Participations")->FindParticipation($event, $user);
        var_dump($Participent);
        if (empty($Participent)) {
            $Participer = new Participations();
            var_dump($request->get('idevenement'));
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('SoukElMedinaPidevBundle:Evenements');
            $Evenement = $repository->findOneBy(array('id' => $request->get('idevenement')));
            var_dump($Evenement);
            $Participer->setIdevenement($Evenement);
            $Participer->setIduser($this->getUser());
            var_dump($Participer);
            $EM->persist($Participer);
            $EM->flush();
            $EM->getRepository("SoukElMedinaPidevBundle:Evenements")->UpdatePlace($request->get('idevenement'));
            return $this->render("@SoukElMedinaEvenement/evenements/participation.html.twig");
        } else {
            return $this->render("@SoukElMedinaEvenement/evenements/echec.html.twig");
        }
    }

    public function showINCAction(Evenements $evenement)
    {

        $em = $this->getDoctrine()->getManager();
//        $time = new \DateTime();
//        $time->format('Y-m-d');
        $DC = (new \DateTime('now'))->format("d/m/Y H:i");
//        var_dump($DC);
        $NPR=$evenement->getNombredesplacesrestante();
        $DD=$evenement->getDate();
        $DF=$evenement->getDatefin();
        if(($DD>=$DC) ||($DF>$DC))
            {
                $var=true;
            }
            else
            {
                $var=false;
            }

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);

        return $this->render('SoukElMedinaEvenementBundle:evenements:showINC.html.twig', array(
            'evenement' => $evenement, 'evenements' => $evenements,'var'=>$var,'npr'=>$NPR
        ));


    }
}
