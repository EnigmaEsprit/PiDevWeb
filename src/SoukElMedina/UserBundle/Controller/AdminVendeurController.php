<?php

namespace SoukElMedina\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminVendeurController extends Controller
{

    public function indexVendeurAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vendeurs = $em->getRepository('SoukElMedinaPidevBundle:Users')->findAll();

        return $this->render('SoukElMedinaUserBundle:vendeur:vendeurList.html.twig',array(
            'vendeurs'=>$vendeurs,
        ));
    }

    public function BloquerVendeurAction($id){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('SoukElMedinaPidevBundle:Users')->find($id);
        $users->setEnabled(false);
        $em->flush();

        return $this->redirectToRoute('souk_el_medina_user_homepagevendeur');
    }

    public function ActiverVendeurAction($id){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('SoukElMedinaPidevBundle:Users')->find($id);
        $users->setEnabled(true);
        $em->flush();

        return $this->redirectToRoute('souk_el_medina_user_homepagevendeur');
    }

    public function supprimerVendeurAction($id){
        $em = $this->getDoctrine()->getManager();
        $vendeur= $em->getRepository("SoukElMedinaPidevBundle:Users")->find("$id");


        return $this->render('@SoukElMedinaUser/vendeur/confirmsuppressionVendeur.html.twig',array(
            'user'=>$vendeur));
    }

    public function confirmSuppressionAction($id){
        $em = $this->getDoctrine()->getManager();
        $vendeur= $em->getRepository("SoukElMedinaPidevBundle:Users")->find("$id");

        $em->remove($vendeur);
        $em->flush();

        return $this->redirectToRoute('souk_el_medina_user_homepagevendeur');
    }
    public function annulerSuppressionAction(){

        return $this->redirectToRoute('souk_el_medina_user_homepagevendeur');
    }
}
