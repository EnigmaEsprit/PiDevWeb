<?php

namespace SoukElMedina\PanierBundle\Controller;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use SoukElMedina\PidevBundle\Entity\Commandes;
use SoukElMedina\PidevBundle\Entity\Lignecommandes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use SoukElMedina\PanierBundle\Controller\Paypal;
use SoukElMedina\PidevBundle\Entity\Produits;

use SoukElMedina\PanierBundle\Repository\panierRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use SoukElMedina\PanierBundle\random_compat\lib\random;

class PanierController extends Controller
{

    public static function quantiteProduitPanierAction(Request $request){

        $session = $request->getSession();
        if($session->has('panier')){
            $articles = count($session->get('panier'));
        }else{
            $articles =0;
        }

        return $articles;
    }

    public function supprimerPanierAction(Request $request,$id){

        $session = $request->getSession();

        $panier = $session->get('panier');
        if(array_key_exists($id,$panier)){
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }
        return $this->redirectToRoute('souk_el_medina_panier_homepage');

    }
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        // $session->remove('panier');
        //die();
        if(!$session->has('panier'))
        {
            $session->set('panier',array());
        }
        // var_dump($session->get('panier'));
        //die();
        $em = $this->getDoctrine()->getManager();
        $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
            ->findProduitInSessionArray(array_keys($session->get('panier')));

        $produitsprom = $em->getRepository('SoukElMedina\PidevBundle\Entity\Promotions')
            ->findProduitPromotionInSessionArray(array_keys($session->get('panier')));

//        foreach ($produits as $produit){
//            var_dump($produit->getIdproduit());
//        }
//        var_dump($session->get('panier'));
//        foreach ($produitsprom as $produit){
//            var_dump($produit->getIdproduit());
//            var_dump(0);
//        }
//
//       // var_dump($produitsprom);
//
//        die();
        return $this->render('SoukElMedinaPanierBundle:Default:panier.html.twig',array(
            'produits' =>$produits,
            'panier' =>$session->get('panier'),
            'qteProduitPanier'=> PanierController::quantiteProduitPanierAction($request)
        ));
    }

    public function validerPanierAction(Request $request){


        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

        $session = $request->getSession();
        if(!$session->has('panier'))
        {
            $session->set('panier',array());
        }

        if(sizeof($session->get('panier')) ==0 ){
            return $this->redirectToRoute('souk_el_medina_pidev_homepage');
        }

        $em = $this->getDoctrine()->getManager();

        $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
            ->findProduitInSessionArray(array_keys($session->get('panier')));


        $paypal = $this->paypalAction($request);
        //var_dump($paypal);
        // die();


        return $this->render('SoukElMedinaPanierBundle:Default:ValiderPanier.html.twig',array(
            'produits' =>$produits,
            'panier' =>$session->get('panier'),
            'qteProduitPanier'=> PanierController::quantiteProduitPanierAction($request),
            'paypal'=>$paypal
        ));
    }
    public function ajouterPanierAction(Request $request,$id){


        $session = $request->getSession();

        if(!$session->has('panier'))
        {

            $session->set('panier',array());
        }
        $panier = $session->get('panier');

        if(array_key_exists($id,$panier)){
            if($request->get('quantite')!=null){
                $panier[$id] = $request->get('quantite');
            }
        }else{
            if($request->get('quantite')!=null){
                $panier[$id] = $request->get('quantite');
            }else{
                $panier[$id]=1;
            }
        }

        $session->set('panier',$panier);

        return $this->redirectToRoute('souk_el_medina_panier_homepage');
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
            if ($produit->getValid() ==0 )
                $prixT = ($produit->getPrixproduit() * $panier[$produit->getIdproduit()]);
             else
                 $prixT = ($produit->getNewPrix() * $panier[$produit->getIdproduit()]);


            $Prixtotal = $Prixtotal + $prixT;
        }

        return $Prixtotal;
    }


    private $user = "JesusChrist_api1.gmail.com";
    private $password= "RJ4BQ558WRQ4CH7C";
    private $signature= "AFcWxV21C7fd0v3bYYYRCpSSRl31AtF5p-47wJpC211EGA-18d13MCtX";

    private $endpoint='https://api-3t.sandbox.paypal.com/nvp';
    public $errors =array();

    public function __construct($user =false,$password = false,$signature=false,$prod=false){
        if($user){
            $this->user =$user;
        }
        if($password){
            $this->password =$password;
        }
        if($signature){
            $this->signature =$signature;
        }
        if($prod){
            $this->endpoint =str_replace('sandbox.', '', $this->endpoint);
        }
    }

    public function request($method,$params){
        $params =array_merge($params,array(
            'METHOD' => $method,
            'VERSION'  =>'95.0',
            'USER'=> $this->user,
            'SIGNATURE' =>	$this->signature,
            'PWD' =>$this->password));
        $params=http_build_query($params);
        //var_dump($params);
        $curl =curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL  =>$this->endpoint,
            CURLOPT_POST  =>1,
            CURLOPT_POSTFIELDS  =>$params,
            CURLOPT_RETURNTRANSFER  =>1,
            CURLOPT_SSL_VERIFYPEER  =>false,
            CURLOPT_SSL_VERIFYHOST  =>false,
            CURLOPT_VERBOSE  =>1
        ));
        $response = curl_exec($curl);
        $responseArray =array();
        parse_str($response,$responseArray);
        //var_dump($responseArray);

        if(curl_errno($curl)){
            $this->errors= curl_error($curl);
            curl_close($curl);
            return false;
        }else{
            if($responseArray['ACK'] == 'Success'){
                curl_close($curl);
                return $responseArray;
            }else{
                $this->errors =$responseArray;
                curl_close($curl);
                return false;
            }

        }
    }


    public  function  paypalAction(Request $request)
    {

        $totalttc =  $this->prixTotal($request);

        $session = $request->getSession();
        if(!$session->has('panier'))
        {
            $session->set('panier',array());
        }

        $nbArticles=sizeof($session->get('panier'));
         $panier = $session->get('panier');

        $ids = array('id'=>'ARkmMcAyN4jWUg0l0xqZA54rOLM8NZQag7rZQBhBPZsCl0reBky9oVF9h46sWrp4-oKqSnU8vab3JbEF',
            'secret'=>'EMuZWnM3VUBc09k5rG29sDFTvWI0dVnC5M0mT3u-9UwWpksnK2gTRPUW0pqIBdzsoHF-i6i_5yBGOhtE');

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $ids['id'],
                $ids['secret']
            )
        );


        $em = $this->getDoctrine()->getManager();
        $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
            ->findProduitInSessionArray(array_keys($session->get('panier')));

        $produitsprom = $em->getRepository('SoukElMedina\PidevBundle\Entity\Promotions')
            ->findProduitPromotionInSessionArray(array_keys($session->get('panier')));

        $list = new ItemList();

        foreach($produits as $k => $product){

            $item = new Item();
            if($product->getValid() == 0){
                $item->setName( $product->getNomproduit())
                    ->setCurrency("USD")
                    ->setQuantity($panier[$product->getIdproduit()])
                    ->setPrice($product->getPrixproduit());
            }else{
                $item->setName( $product->getNomproduit())
                    ->setCurrency("USD")
                    ->setQuantity($panier[$product->getIdproduit()])
                    ->setPrice($product->getNewPrix());
            }

            $list->addItem($item);
        }

        $details = new Details();
        $details->setSubtotal($totalttc);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($totalttc)
            ->setDetails($details)
            ->setCurrency("USD");


        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($list)
            ->setDescription("Achat sur Souk El Medina")

            ->setAmount($amount)
            ->setCustom('demo-1');


        $payment = new Payment();
        $payment->setIntent('sale');
        $redirectUrls = (new RedirectUrls())
            ->setReturnUrl('http://localhost/PiDevWeb/web/preparecommande')
            ->setCancelUrl('http://localhost/PiDevWeb/web/cancelcommande');
        $payment->setRedirectUrls($redirectUrls);

        $payment->setPayer((new Payer())->setPaymentMethod('paypal'));

        $payment->setTransactions([$transaction]);

        try{
            $payment->create($apiContext);
            return $this->json([
                    'id'=>$payment->getId()
                ]

            ) ;
                //json_encode();

            //return $id;
            //return $payment->getApprovalLink();
            //header('Location: '.$payment->getApprovalLink());
            // $this->redirect($payment->getApprovalLink());
        }catch (PayPalConnectionException $e){
            var_dump(json_decode($e->getData()));
        }

    }




    public  function process(Request $request)
    {
        $port  =10.0;

        $paypal = new PanierController();
        $totalttc = $this->prixTotal($request);

        $response = $paypal->request('GetExpressCheckoutDetails',array('TOKEN' => $_GET['token']));

        if($response){
            //var_dump($response);
            if($response['CHECKOUTSTATUS'] = 'PaymentActionCompleted'){
                echo ' paiement  validé';
            }
        }else{
            var_dump($paypal->errors);
            die();
        }

        $params =array(
            'TOKEN' =>$_GET['token'],
            'PAYERID' =>$_GET['PayerID'],
            'PAYMENTACTION' => 'Sale',



            'PAYMENTREQUEST_0_AMT' => $totalttc +$port,
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
            'PAYMENTREQUEST_0_SHIPPINGAMT'  => $port,
            'PAYMENTREQUEST_0_ITEMAMT'  =>$totalttc);

        $session = $request->getSession();

        if(!$session->has('panier'))
        {
            $session->set('panier',array());
        }

        $em = $this->getDoctrine()->getManager();
        $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
            ->findProduitInSessionArray(array_keys($session->get('panier')));

        $panier = $session->get('panier');
        foreach($produits as $k => $product){
            $params["L_PAYMENTREQUEST_0_NAME$k"] = $product->getNomproduit();
            $params["L_PAYMENTREQUEST_0_DESC$k"] = '';
            $params["L_PAYMENTREQUEST_0_AMT$k"] = $product->getPrixproduit();
            $params["L_PAYMENTREQUEST_0_QTY$k"] = $panier[$product->getIdproduit()];
        }

        $response = $paypal->request('DoExpressCheckoutPayment',$params);



        return $response;
    }
    public function cancelCommandeAction(){

        return  $this->render('SoukElMedinaPanierBundle:Default:cancel.html.twig',array(

        ));
    }
    public function prepareCommandeAction(Request $request){

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        $ids = array('id'=>'ARkmMcAyN4jWUg0l0xqZA54rOLM8NZQag7rZQBhBPZsCl0reBky9oVF9h46sWrp4-oKqSnU8vab3JbEF',
            'secret'=>'EMuZWnM3VUBc09k5rG29sDFTvWI0dVnC5M0mT3u-9UwWpksnK2gTRPUW0pqIBdzsoHF-i6i_5yBGOhtE');

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $ids['id'],
                $ids['secret']
            )
        );

        //$payment = Payment::get($request->get('paymentId'),$apiContext);
        $payment = Payment::get($request->get('paymentID'),$apiContext);

        $execution = (new PaymentExecution())
            ->setPayerId($request->get('payerID'))
            ->setTransactions($payment->getTransactions());

        // ->setPayerId($request->get('PayerID'))

        try{
          $payment->execute($execution,$apiContext);

            $idTrans = $payment->getId();//sauvegarder l'id transaction dans la bd

        }catch (PayPalConnectionException $e){
            \Symfony\Component\Debug\header('',true,500);
            var_dump(json_decode($e->getData()));
        }



       // $idTrans = $request->get('paymentId');//sauvegarder l'id transaction dans la bd


        if($idTrans != null){
            $commande = new Commandes();

            $commande->setDatedecommande(new \DateTime());
            $commande->setEtat(1);
            $commande->setIduser($this->getUser());
            //$this->container->get('security.context_listener')->getToken()->getUser();
            /** @var TYPE_NAME $idTrans */
            $commande->setIdtransaction($idTrans);
            $commande->setReference($this->reference());
            $commande->setPrixtotal($this->prixTotal($request));
            $commande->setCommande($this->facture($request));

            $em->persist($commande);

            $em->flush();

            /*$cmd = $em->getRepository('SoukElMedinaPidevBundle:Commandes')
                            ->findBy(array('idtransaction'=>$idTrans));*/
            $cmd = $em->getRepository('SoukElMedinaPidevBundle:Commandes')
                ->findIdCmdTab($idTrans);

            //var_dump($cmd);

            $ligneCmd = new Lignecommandes();

            $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
                ->findProduitInSessionArray(array_keys($session->get('panier')));

            $panier = $session->get('panier');

            //var_dump($cmd);
            foreach ($cmd as $c){
                $idcmd = $c;
            }

            // var_dump($idcmd);

            foreach ($idcmd as $k=>$c){
                $idcmd1 = $k;
            }
            //var_dump($idcmd[$idcmd1]);

            foreach($produits as $k => $product){
                $ligneCmd->setIdcommande($idcmd[$idcmd1]);
                $ligneCmd->setQuantite($panier[$product->getIdproduit()]);
                if ($product->getValid() ==0 ){
                    $ligneCmd->setPrixunitaire($product->getPrixproduit());
                    $ligneCmd->setPrixtotal($product->getPrixproduit()*$panier[$product->getIdproduit()]);
                }
                else{
                    $ligneCmd->setPrixunitaire($product->getNewPrix());
                    $ligneCmd->setPrixtotal($product->getNewPrix()*$panier[$product->getIdproduit()]);
                }


                $ligneCmd->setIdproduit($product->getIdproduit());
                var_dump($product->getIdproduit());
                $ligneCmd->setIdmagasin(1);
                $em->persist($ligneCmd);
                $em->flush();
                $em->clear();
            }

            $session->remove('panier');

//email: $commande->setIduser()->getEmailCanonical()
            $message = \Swift_Message::newInstance()
                ->setSubject('SoukElMedina: Validation de votre Commande')
                ->setFrom(array('jeandavidbikie@gmail.com' => 'jeanlemignon'))
                ->setTo('jean.bikiembida@esprit.tn')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('SoukElMedinaPanierBundle:Default:ValiderCommandeMail.html.twig'));

            $this->get('mailer')->send($message);

        }
        return  $this->render('SoukElMedinaPanierBundle:Default:process.html.twig',array(

            'user'=>$this->getUser()
        ));

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

            if($produit->getValid()==0){
                $prixT =($produit->getPrixproduit() * $panier[$produit->getIdproduit()]);
                $Prixtotal=$Prixtotal+$prixT;

                $commande['produit'][$produit->getIdproduit()] = array('nomProduit'=> $produit->getNomproduit(),
                    'quantiteproduit' =>$panier[$produit->getIdproduit()],
                    'prixProduit'=>round($produit->getPrixproduit(),2),
                    'promotion'=> 0);
            }else{
                $prixT =($produit->getNewPrix() * $panier[$produit->getIdproduit()]);
                $Prixtotal=$Prixtotal+$prixT;

                $commande['produit'][$produit->getIdproduit()] = array('nomProduit'=> $produit->getNomproduit(),
                    'quantiteproduit' =>$panier[$produit->getIdproduit()],
                    'prixProduit'=>round($produit->getNewPrix(),2),
                    'promotion'=> 1);
            }

            $commande['client'] =$this->getUser();
            $commande['Prixtotal'] = round($Prixtotal,2);
            $commande['token']= bin2hex($generator);


        }
        return $commande;
    }
    public function reference(){

        $em = $this->getDoctrine()->getManager();
        $reference = $em->getRepository('SoukElMedinaPidevBundle:Commandes')
            ->findOneBy(array('etat' =>1),
                array('idcommande' =>'DESC'),1,1);

        if(!$reference)
            return 1;
        else
            return $reference->getReference()+1;
    }




}
