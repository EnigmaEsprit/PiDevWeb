<?php

namespace SoukElMedina\PanierBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Commandes;
use SoukElMedina\PidevBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use SoukElMedina\PanierBundle\random_compat\lib\random;


class CommandeVendeurController extends Controller
{


    /**
     * CommandeController constructor.
     */
    public function __construct()
    {
    }



    public function CommandesAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $findcommandes = $em->getRepository('SoukElMedinaPidevBundle:Commandes')->findAll();

        $commandes  = $this->get('knp_paginator')->paginate(
            $findcommandes,
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return  $this->render('SoukElMedinaPanierBundle:Vendeur:commande.html.twig',array(
            'commandes'=>$commandes,
            'totalcommandes'=>$findcommandes
        ));
    }


}
