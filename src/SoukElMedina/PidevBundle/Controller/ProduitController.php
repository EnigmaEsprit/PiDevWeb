<?php

namespace SoukElMedina\PidevBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Produits;
use SoukElMedina\PidevBundle\Entity\Promotions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    public function produitAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:produit.html.twig');
    }
    public function detailAction(Request $request,$id)
    {
        $produit = new Produits();
        $session = $request->getSession();
        $em= $this->getDoctrine()->getManager();
        $produit = $em->getRepository('SoukElMedinaPidevBundle:Produits')->find("$id");
        $promotion = $em->getRepository('SoukElMedinaPidevBundle:Promotions')->find("$id");
        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}

        return $this->render('SoukElMedinaPidevBundle:Default:detail.html.twig',array(
            'produit'=>$produit,
            'promotion'=>$promotion,
            'panier'=>$panier,
            'qteProduitPanier'=> sizeof($session->get('panier'))
        ));
    }
    public function detailPROMAction(Request $request,Promotions $promotions)
    {
        $produit = new Produits();
        $session = $request->getSession();
        $em= $this->getDoctrine()->getManager();
        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}

        return $this->render('@SoukElMedinaPromotion/promotions/detais.html.twig',array(
            'promotion'=>$promotions,
            'panier'=>$panier,
            'qteProduitPanier'=> sizeof($session->get('panier'))
        ));
    }
}
