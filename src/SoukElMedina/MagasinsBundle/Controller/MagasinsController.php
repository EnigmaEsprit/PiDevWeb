<?php

namespace SoukElMedina\MagasinsBundle\Controller;

use blackknight467\StarRatingBundle\Form\RatingType;
use SoukElMedina\PidevBundle\Entity\Magasins;
use SoukElMedina\PidevBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MagasinsController extends Controller
{


    public function ListerMagasinsAction(Request $request)
    {
//        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

//      $rating=$em->getRepository('SoukElMedinaPidevBundle:Rating')->findAll();
//        $form=$this->createFormBuilder($rating)
//            ->add('rating', RatingType::class, [
//                'label' => 'Rating'
//            ])
//            ->add('valider',SubmitType::class, array(
//                'attr' => array(
//
//                    'class'=>'btn btn-xs btn-primary'
//                )))
//            ->getForm();
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em->persist($rating);
//            $em->flush();
//        }
        $session = $request->getSession();
        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}
        $magasin = $em->getRepository('SoukElMedinaPidevBundle:Magasins')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $magasin,
            $request->query->getInt('page', 1),
            1   );
        return $this->render('@SoukElMedinaMagasins/Magasins/showAll.html.twig', array(
            'page' => $pagination,  'qteProduitPanier'=> sizeof($session->get('panier'))

        ));
    }

    public function ShowDetailAction(Request $request,$idmagasin){


        $em= $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}

        $magasin=$em->getRepository("SoukElMedinaPidevBundle:Magasins")->find($idmagasin);
        return $this->render('SoukElMedinaMagasinsBundle:Magasins:DetailMagasins.html.twig', array(
            "magasin"=>$magasin, 'qteProduitPanier'=> sizeof($session->get('panier'))));
    }


    public function MonMagasinDetailAction(Request $request){


        $em= $this->getDoctrine()->getManager();
        $id=$this->getUser();
        $magasin=$em->getRepository("SoukElMedinaPidevBundle:Magasins")->findOneBy(array('iduser'=>$id));
        $session = $request->getSession();
        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}

        return $this->render('SoukElMedinaMagasinsBundle:Magasins:DetailMagasinsVendeur.html.twig', array(
            "magasin"=>$magasin,    'qteProduitPanier'=> sizeof($session->get('panier'))));
    }

    public function showProduitsAction($idmagasin){


        $em= $this->getDoctrine()->getManager();

        $produit = $em->getRepository(Produits::class)->findBy(array('idmagasin'=>$idmagasin));
        return $this->render('@SoukElMedinaMagasins/Magasins/showProduitMagasins.html.twig', array(
            "produit"=>$produit));
    }


    function GeneratePdfAction($id)
    {
        $em=$this->getDoctrine()->getManager();
            $magasin=$em->getRepository('SoukElMedinaPidevBundle:Magasins')->findOneBy(array('idmagasin'=>$id));

       // $images[$magasin->getIdmagasin()]=$em->getRepository('MyAppUserBundle:Image')->findBy(array('idAnnonce'=>$magasin->getIdAnnonce()));

        $html = $this->renderView('SoukElMedinaMagasinsBundle:Magasins:MagasinPDF.html.twig', array(
            'r'  => $magasin
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Facture.pdf"'
            )
        );
    }



}
