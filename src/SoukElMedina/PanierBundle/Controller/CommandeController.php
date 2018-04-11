<?php

namespace SoukElMedina\PanierBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Commandes;
use SoukElMedina\PidevBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use SoukElMedina\PanierBundle\random_compat\lib\random;


class CommandeController extends Controller
{


    /**
     * CommandeController constructor.
     */
    public function __construct()
    {
    }

    public function facture(Request $request){

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        //$generator = $this->container->get('security.secure_random');
        try {
            $generator = random_bytes(32);
        } catch (TypeError $e) {
            // Well, it's an integer, so this IS unexpected.
            die("An unexpected error has occurred");
        } catch (Error $e) {
            // This is also unexpected because 32 is a reasonable integer.
            die("An unexpected error has occurred");
        } catch (Exception $e) {
            // If you get this message, the CSPRNG failed hard.
            die("Could not generate a random string. Is our OS secure?");
        }

        //var_dump(bin2hex($generator));
        $panier = $session->get('panier');
        $commande = array();
        $Prixtotal=0;


        $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
            ->findProduitInSessionArray(array_keys($session->get('panier')));

        foreach ($produits as $produit){
            $prixT =($produit->getPrixproduit() * $panier[$produit->getIdproduit()]);
            $Prixtotal=$Prixtotal+$prixT;

            $commande['produit'][$produit->getIdproduit()] = array('nomProduit'=> $produit->getNomproduit(),
                                                                    'quantiteproduit' =>$produit->getQuantiteproduit(),
                                                                    'prixProduit'=>round($produit->getPrixproduit(),2));
            $commande['Prixtotal'] = round($Prixtotal,2);
            $commande['token']= bin2hex($generator);


        }
        return $commande;
    }
    public function prixTotal(Request $request){
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        if(!$session->has('panier'))
        {
            $session->set('panier',array());
        }

        $Prixtotal=0;

        $panier = $session->get('panier');
        $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
            ->findProduitInSessionArray(array_keys($session->get('panier')));

        foreach ($produits as $produit) {
            $prixT = ($produit->getPrixproduit() * $panier[$produit->getIdproduit()]);
            $Prixtotal = $Prixtotal + $prixT;
        }

        return $Prixtotal;
    }
    public function prepareCommandeAction(Request $request){

       $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();


        $commande = new Commandes();

        $commande->setDatedecommande(new \DateTime());
        $commande->setEtat(0);
        $commande->setIduser($this->getUser());
        //$this->container->get('security.context_listener')->getToken()->getUser();
        $commande->setIdtransaction(0);
        $commande->setPrixtotal($this->prixTotal($request));
        $commande->setCommande($this->facture($request));

        //var_dump($commande);


        $em->persist($commande);

        $em->flush();


        var_dump('aaaaaaaaaaaaaaaaaaaaa');
        $panierController = new PanierController();
        //var_dump($response->process($request));
        var_dump('aaaaaaaaaaaaaaaaaaaaa');
       // $response = $panierController->process($request);
        $response = $this->get('souk_el_medina_panier_process_service');


        var_dump($response);
        die();
        if($response['ACK']== 'FAILURE')
        {
            die('le paiement n a pas ete effectue');
        }

        $idTrans = $response['PAYMENTINFO_0_TRANSACTIONID'];//sauvegarder l'id transaction dans la bd

        var_dump($idTrans);
        die();

       // return new Response($commande->getIdcommande());
        return  $this->render('SoukElMedinaPanierBundle:Default:process.html.twig',array(

        ));
    }
}
