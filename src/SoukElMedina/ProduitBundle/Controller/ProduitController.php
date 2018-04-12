<?php

namespace SoukElMedina\ProduitBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Magasins;
use SoukElMedina\PidevBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{





    public function ListerProduitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = new Produits();
        $form = $this->createForm('SoukElMedina\PidevBundle\Form\ProduitsSearch', $produit);

        $produits = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findAll();

        $paginator  = $this->get('knp_paginator')->paginate(
            $produits,
            $request->query->getInt('page', 1),
            10  );
        $session = $request->getSession();
        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}
        return $this->render('SoukElMedinaProduitBundle:Default:ShowAllProduit.html.twig', array(
            'produits' => $paginator,
            'form' => $form->createView(),'qteProduitPanier'=> sizeof($session->get('panier'))

        ));
    }
    public function RechercheParcategorieAction($categorie)

    {
        $em = $this->getDoctrine()->getManager();
        $v=null;
        $produits = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findBy(array('categoriemagasin'=>$categorie));
        foreach ($produits as $produit){
            $v[ $produit->getIdproduit()] = array($produit->getReferenceproduit(),
                $produit->getNomproduit(),$produit->getPrixproduit(),$produit->getPhotoproduit(),
                $produit->getQuantiteproduit(),$produit->getActive(),$produit->getIdpromotion(),$produit->getCategoriemagasin()
            ,$produit->getIdmagasin()->getNommagasin(), $produit->getIdproduit());
        }
        $response = new JsonResponse();
        return $response->setData($v);
    }

    public function ShowDetailAction($idproduit,Request $request){

            $em= $this->getDoctrine()->getManager();
        $zffecte=new Produits();
        $note=$this->createForm('SoukElMedina\ProduitBundle\Form\rating2', $zffecte);
        $note->handleRequest($request);
        if($note->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('SoukElMedinaPidevBundle:Produits')->find($idproduit);
            $rqte=$note->get('note')->getData();


//            var_dump($rqte) ;
//            die();
        }
        $session = $request->getSession();
        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}

        $produits=$em->getRepository("SoukElMedinaPidevBundle:Produits")->find($idproduit);
            return $this->render('SoukElMedinaProduitBundle::DetailProduit.html.twig', array(
                "produits"=>$produits,
                 'rech'=>$note->createView(),'qteProduitPanier'=> sizeof($session->get('panier'))
            ));
        }
    public function ShowProduitAction(Request $request,$idB)
    {
        $feedback = new Produits();
        $em = $this->getDoctrine()->getManager();
        $boutique = $em->getRepository('SoukElMedina\PidevBundle\Entity\Magasins')->findOneBy(array(
            'idmagasin' => $idB));


            $em = $this->getDoctrine()->getManager();

            $feedback->setIdmagasin($boutique);
            $em->persist($feedback);
            $em->flush();
            return $this->redirectToRoute("souk_el_medina_produit");


        return $this->render('@SoukElMedinaPidevBundle:Default:produit.html.twig', array(
            'feedback' => $feedback,
            'form' => $form->createView(),
        ));
    }


}
