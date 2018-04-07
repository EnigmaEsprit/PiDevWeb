<?php

namespace SoukElMedina\PidevBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED') and $this->isGranted('ROLE_VENDEUR')) {

            return $this->redirectToRoute('souk_el_medina_pidev_homepage_Vendeur');
        }

        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED') and $this->isGranted('ROLE_USER')) {
            //$em = $this->getDoctrine()->getManager();
//        $time = new \DateTime();
//        $time->format('Y-m-d');
            $session = $request->getSession();
            $DC=(new \DateTime('now'))->format("d/m/Y H:i");
            //var_dump($DC);
            if($session->has('panier')){
                $panier = $session->get('panier');
            }
            else{ $panier=false;}

            $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);
            $produits = $em->getRepository("SoukElMedinaPidevBundle:Produits")->findAll();

            return $this->render('@SoukElMedinaPidev/Default/index.html.twig', array(
                'evenements' => $evenements,
                'Produits'=>$produits,
                'panier'=>$panier,
                'qteProduitPanier'=> sizeof($session->get('panier'))
            ));

        }

//        $time = new \DateTime();
//        $time->format('Y-m-d');
        $DC=(new \DateTime('now'))->format("d/m/Y H:i");
       // var_dump($DC);
        $session = $request->getSession();

        $produits = $em->getRepository("SoukElMedinaPidevBundle:Produits")->findAll();

        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);

        return $this->render('SoukElMedinaPidevBundle:Default:index.html.twig', array(
            'evenements' => $evenements,
            'Produits'=>$produits,
            'panier'=>$panier,
            'qteProduitPanier'=> sizeof($session->get('panier'))
        ));

    }
    public function indexVendeurAction()
    {
        $userID = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('iduser'=>$userID));

        return $this->render('@SoukElMedinaPidev/Default/indexVendeur.html.twig', array(
            'evenements' => $evenements,
        ));

    }
    public function indexAdminAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:indexAdmin.html.twig');
    }
    public function indexClientAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:Client.html.twig');
    }

}
