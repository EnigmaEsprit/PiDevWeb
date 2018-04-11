<?php

namespace SoukElMedina\ReclamationBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Magasins;
use SoukElMedina\PidevBundle\Entity\Reclamations;
use SoukElMedina\PidevBundle\Entity\Users;
use SoukElMedina\PidevBundle\SoukElMedinaPidevBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReclamationsController extends Controller
{

    /***************     Fonctions  Clients   *******************/

    public function indexClientSideAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_CLIENT'))
        {
        $em = $this->getDoctrine()->getManager();
        $session = $request -> getSession();
        $user = $em->getRepository('SoukElMedinaPidevBundle:Users') -> find($this->getUser());
        $nbre = $user -> getNombredereclamations();
        $reclamation = new Reclamations();
        $currentDateTime = (new \DateTime('now'))->format("Y-m-d H:i:s");
        $form = $this->createForm('SoukElMedina\ReclamationBundle\Form\ReclamationsType', $reclamation);
        $form->handleRequest($request);
        $magasins = $em -> getRepository('SoukElMedinaPidevBundle:Magasins') -> findAll();

        if($session -> has('panier')) {
            $panier = $session -> get('panier');
        }
        else { $panier = false; }

        if ($form->isSubmitted() && $form->isValid() && $nbre <= 2) {
            $reclamation -> setIduser($this -> getUser());
            $reclamation -> setDateenvoireclamation(date_create($currentDateTime));
            $reclamation -> setTypereclamation($request -> get('recl'));
            $reclamation -> setStatusreclamation(0);
            $reclamation -> setSuivireclamation("En attente");
            $user -> setNombredereclamations($nbre+1);
            $em->persist($reclamation);
            $em->flush();
            $message = "Votre réclamation a été bien envoyée.";
            echo "<script type='text/javascript'>alert('$message');</script>";
            return $this->redirectToRoute('reclamations_suivi_client');
            //
        }
        if ($form->isSubmitted() && $form->isValid() && $nbre >= 2) {
            $erreur = "Désolé, vous avez atteint la limite de réclamations autorisée!";
            echo "<script type='text/javascript'>alert('$erreur');</script>";
        }

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:envoi_reclamation.html.twig', array(
            'form' => $form->createView(),
            'listeMagasins' => $magasins,
            'qteProduitPanier' => sizeof($session -> get('panier'))
        ));

        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function suiviReclamationsAction()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_CLIENT')) {
            $em = $this->getDoctrine()->getManager();
            $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations')->printReclamations($this->getUser());

            return $this->render('SoukElMedinaReclamationBundle:Reclamations:consulter_reclamations_client.html.twig', array(
                'reclamations' => $reclamations,
            ));
        }
        else
            {
                return $this->redirectToRoute('souk_el_medina_pidev_homepage');
            }
    }


    /***************     Fonctions  Vendeurs   *******************/

    public function indexVendeurSideAction()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_VENDEUR')) {
            $em = $this->getDoctrine()->getManager();
        $magasin = $em -> getRepository('SoukElMedinaPidevBundle:Magasins') -> findMagasinID($this -> getUser());

        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findReclamations($magasin);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:consulter_reclamations.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
            {
                return $this->redirectToRoute('souk_el_medina_pidev_homepage');
            }
    }

    public function indexVendeurSide2Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_VENDEUR')) {
        $em = $this->getDoctrine()->getManager();
        $magasin = $em -> getRepository('SoukElMedinaPidevBundle:Magasins') -> findMagasinID($this -> getUser());

        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findReclamationsParDate($magasin, 3);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:consulter_reclamations.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function indexVendeurSide3Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_VENDEUR')) {
            $em = $this->getDoctrine()->getManager();
        $magasin = $em -> getRepository('SoukElMedinaPidevBundle:Magasins') -> findMagasinID($this -> getUser());

        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findReclamationsParDate($magasin, 7);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:consulter_reclamations.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function indexVendeurSide4Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_VENDEUR')) {
            $em = $this->getDoctrine()->getManager();
        $magasin = $em -> getRepository('SoukElMedinaPidevBundle:Magasins') -> findMagasinID($this -> getUser());

        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findReclamationsParDate($magasin, 30);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:consulter_reclamations.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function detailsReclamationAction($id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_VENDEUR')) {
        $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> find($id);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:consulter_details_reclamation.html.twig', array(
            'reclamation' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function deleteReclamationAction($id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_VENDEUR')) {
        $EM = $this->getDoctrine()->getManager();
        $reclamation = $EM->getRepository("SoukElMedinaPidevBundle:Reclamations")->find($id);
        $EM->remove($reclamation);
        $EM->flush();
        return $this->redirectToRoute('reclamations_consultationVendeur');
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }



    /***************     Fonctions  Admin   *******************/

    public function reclamationsShowAdminAction()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findStatus();

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:reclamations_cote_Admin.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function reclamationsShowAdmin2Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findReclamationsParDateAdmin(3);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:reclamations_cote_Admin.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function reclamationsShowAdmin3Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findReclamationsParDateAdmin(7);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:reclamations_cote_Admin.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function reclamationsShowAdmin4Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> findReclamationsParDateAdmin(30);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:reclamations_cote_Admin.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function reclamationsShowAdmin5Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations')
            -> findReclamationsParType('Réclamation liée à une vente');

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:reclamations_cote_Admin.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function reclamationsShowAdmin6Action()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations')
            -> findReclamationsParType('Réclamation liée au système');

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:reclamations_cote_Admin.html.twig', array(
            'reclamations' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function detailsReclamationAdminAction($id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();
        $reclamations = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> find($id);

        return $this->render('SoukElMedinaReclamationBundle:Reclamations:details_reclamation_cote_Admin.html.twig', array(
            'reclamation' => $reclamations,
        ));
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function deleteReclamationAdminAction($id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
            $EM = $this->getDoctrine()->getManager();
        $reclamation = $EM->getRepository("SoukElMedinaPidevBundle:Reclamations")->find($id);
        $EM->remove($reclamation);
        $EM->flush();
        return $this->redirectToRoute('reclamations_consultationAdmin');
        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

    public function faireSuivreReclamationAction($id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        if($this->isGranted('ROLE_ADMIN')) {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("SoukElMedinaPidevBundle:Reclamations")->find($id);
        $reclamation ->setStatusreclamation(1);
        $em->flush();
        return $this->redirectToRoute('reclamations_consultationAdmin');

        }
        else
        {
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }
    }

}
