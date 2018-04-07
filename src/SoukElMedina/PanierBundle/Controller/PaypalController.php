<?php

namespace SoukElMedina\PanierBundle\Controller;
use SoukElMedina\PanierBundle\Repository\panierRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaypalController extends Controller
{

    private $ids = array('id'=>'ARkmMcAyN4jWUg0l0xqZA54rOLM8NZQag7rZQBhBPZsCl0reBky9oVF9h46sWrp4-oKqSnU8vab3JbEF',
        'secret'=>'EMuZWnM3VUBc09k5rG29sDFTvWI0dVnC5M0mT3u-9UwWpksnK2gTRPUW0pqIBdzsoHF-i6i_5yBGOhtE');

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
        //curl_close($curl);


    }


    public  function  paypal(Request $request)
    {

        $total = 61.0;
        //$totalttc = Panier::MontantGlobal();

        $totalttc =  $totalttc = $this->prixTotal($request);
        $port  =10.0;

        $paypal = new PaypalController();

        $params =array(
            'RETURNURL' => 'http://localhost/PiDevWeb/web/preparecommande',
            'CANCELURL' => 'http://www.google.com',
            'PAYMENTREQUEST_0_AMT' => $totalttc + $port,
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
            'PAYMENTREQUEST_0_SHIPPINGAMT'  => $port,
            'PAYMENTREQUEST_0_ITEMAMT'  =>$totalttc);



        $session = $request->getSession();
        if(!$session->has('panier'))
        {
            $session->set('panier',array());
        }

        $nbArticles=sizeof($session->get('panier'));

        $panier = $session->get('panier');

        $em = $this->getDoctrine()->getManager();
        $produits =$em->getRepository('SoukElMedinaPidevBundle:Produits')
            ->findProduitInSessionArray(array_keys($session->get('panier')));

        $i=0;
        foreach ($produits as $produit)
        {

            $params["L_PAYMENTREQUEST_0_NAME$i"]= $produit.getNomproduit();
            $params["L_PAYMENTREQUEST_0_DESC$i"] = '';
            $params["L_PAYMENTREQUEST_0_AMT$i"] =$produit.getPrixproduit();
            $params["L_PAYMENTREQUEST_0_QTY$i"]=$panier[$produit.getIdproduit()];
            $i++;
        }


        $response= $paypal->request('SetExpressCheckout',$params);
        if($response){
            $paypal ='https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=' . $response['TOKEN'];
            //var_dump($paypal);
        }else{
            var_dump($paypal->errors);
            //die('Erreur');
        }
        return $paypal;
    }




    public  function process(Request $request)
    {
        $total = 61.0;
        $totalttc = $this->prixTotal($request);
        $port  =10.0;

        $paypal = new PaypalController();


        $response = $paypal->request('GetExpressCheckoutDetails',array('TOKEN' => $_GET['token']));

        if($response){
            //var_dump($response);
            if($response['CHECKOUTSTATUS'] = 'PaymentActionCompleted'){
                echo 'ce paiement a déja été validé';
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
        //$nbArticles=count($_SESSION['panier']['libelleProduit']);

        $i=0;
        foreach ($produits as $produit)
        {

            $params["L_PAYMENTREQUEST_0_NAME$i"]= $produit.getNomproduit();
            $params["L_PAYMENTREQUEST_0_DESC$i"] = '';
            $params["L_PAYMENTREQUEST_0_AMT$i"] =$produit.getPrixproduit();
            $params["L_PAYMENTREQUEST_0_QTY$i"]=$panier[$produit.getIdproduit()];
            $i++;
        }
        $response = $paypal->request('DoExpressCheckoutPayment',$params);

        return $response;

        /*if($response){
            var_dump($response);
            if($response['ACK']== 'FAILURE')
            {
                die('le paiement n a pas ete effectue');
            }

            $response['PAYMENTINFO_0_TRANSACTIONID'];//sauvegarder l'id transaction dans la bd
        }else{
            var_dump($paypal->errors);
        }*/


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
}
