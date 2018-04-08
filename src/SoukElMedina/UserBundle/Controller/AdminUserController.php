<?php

namespace SoukElMedina\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminUserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('SoukElMedinaPidevBundle:Users')->findAll();

        return $this->render('SoukElMedinaUserBundle:Default:index.html.twig',array(
            'users'=>$users,
        ));
    }
    public function indexVendeurAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vendeurs = $em->getRepository('SoukElMedinaPidevBundle:Users')->findAll();

        return $this->render('SoukElMedinaUserBundle:vendeur:vendeurList.html.twig',array(
            'vendeurs'=>$vendeurs,
        ));
    }

    public function BloquerClientAction($id){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('SoukElMedinaPidevBundle:Users')->find($id);
        $users->setEnabled(false);
        $em->flush();

        return $this->redirectToRoute('souk_el_medina_user_homepageclient');
    }

    public function ActiverClientAction($id){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('SoukElMedinaPidevBundle:Users')->find($id);
        $users->setEnabled(true);
        $em->flush();

        return $this->redirectToRoute('souk_el_medina_user_homepageclient');
    }

    public function supprimerClientAction($id){
        $em = $this->getDoctrine()->getManager();
        $client= $em->getRepository("SoukElMedinaPidevBundle:Users")->find("$id");


        return $this->render('@SoukElMedinaUser/Default/confirmsuppression.html.twig',array(
            'user'=>$client));
    }

    public function confirmSuppressionAction($id){
        $em = $this->getDoctrine()->getManager();
        $client= $em->getRepository("SoukElMedinaPidevBundle:Users")->find("$id");

        $em->remove($client);
        $em->flush();

        return $this->redirectToRoute('souk_el_medina_user_homepageclient');
    }
    public function annulerSuppressionAction(){

        return $this->redirectToRoute('souk_el_medina_user_homepageclient');
    }
}
