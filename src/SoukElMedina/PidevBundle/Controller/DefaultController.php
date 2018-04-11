<?php

namespace SoukElMedina\PidevBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED') and $this->isGranted('ROLE_VENDEUR')) {

            return $this->redirectToRoute('souk_el_medina_pidev_homepage_Vendeur');
        }
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED') and $this->isGranted('ROLE_USER')) {
            $em = $this->getDoctrine()->getManager();
            $DC=(new \DateTime('now'))->format("d/m/Y H:i");
            $DC2=(new \DateTime('now'));

            $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);
            $produits = $em->getRepository("SoukElMedinaPidevBundle:Produits")->findBy(array('valid'=>0));

            $prompotions =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->FindOffers($DC2);
            $session = $request->getSession();

            if($session->has('panier')){
                $panier = $session->get('panier');
            }
            else{ $panier=false;}
            $DC=(new \DateTime('now'));
            $prompotion =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->findAll();

            foreach ($prompotion as $prom)
            {
                if($prom->getDatefin()<$DC) {
                    $prod=$prom->getIdproduit();
                    $prod->setValid(0);
//                    $em->persist($prom);
                    $em->flush();
                 }
            }



            return $this->render('@SoukElMedinaPidev/Default/index.html.twig', array(
                'evenements' => $evenements,'promotionsO'=>$prompotions,
                'Produits'=>$produits,
                'panier'=>$panier,
                'qteProduitPanier'=> sizeof($session->get('panier'))
            ));

        }
        $em = $this->getDoctrine()->getManager();
        $DC=(new \DateTime('now'));
        $prompotion =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->findAll();

        foreach ($prompotion as $prom)
        {
            if($prom->getDatefin()<$DC) {
                $prod=$prom->getIdproduit();
                $prod->setValid(0);
//                    $em->persist($prom);
                $em->flush();
            }
        }

        $DC=(new \DateTime('now'))->format("d/m/Y H:i");
        $DC2=(new \DateTime('now'));

        $session = $request->getSession();

        if($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{ $panier=false;}



        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);
        $prompotion =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->FindOffers($DC2);
        $produits = $em->getRepository("SoukElMedinaPidevBundle:Produits")->findBy(array('valid'=>0));


        return $this->render('@SoukElMedinaPidev/Default/index.html.twig', array(
            'evenements' => $evenements,'promotionsO'=>$prompotion,
            'Produits'=>$produits,
            'panier'=>$panier,
            'qteProduitPanier'=> sizeof($session->get('panier'))
        ));

    }
    public function indexVendeurAction()
    {
        $userID = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $prompotion =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->findBy(array('iduser'=>$userID));
        $DC=(new \DateTime('now'));
//        $prompotio =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->findAll();

        foreach ($prompotion as $prom)
        {
//            $D= DateTime::createFromFormat('d/m/Y H:i', $prom->getDatefin());
            if($prom->getDatefin()<$DC) {
                $prom->setEnnable(0);
                $em->persist($prom);
                $em->flush();
            }
        }
        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('iduser'=>$userID));

        return $this->render('@SoukElMedinaPidev/Default/indexVendeur.html.twig', array(
            'evenements' => $evenements,'promotionsO'=>$prompotion,
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
