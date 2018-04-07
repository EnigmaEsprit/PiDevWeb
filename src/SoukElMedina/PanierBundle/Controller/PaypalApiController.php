<?php

namespace SoukElMedina\PanierBundle\Controller;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaypalApiController extends Controller
{

    public function paymentAction(){

         $ids = array('id'=>'ARkmMcAyN4jWUg0l0xqZA54rOLM8NZQag7rZQBhBPZsCl0reBky9oVF9h46sWrp4-oKqSnU8vab3JbEF',
            'secret'=>'EMuZWnM3VUBc09k5rG29sDFTvWI0dVnC5M0mT3u-9UwWpksnK2gTRPUW0pqIBdzsoHF-i6i_5yBGOhtE');

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $ids['id'],
                $ids['secret']
            )
        );


        $list = new ItemList();
        //foreach ()
        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency("USD")
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $details = new Details();
        $details->setSubtotal(17.50);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(17.50)
            ->setDetails($details)
            ->setCurrency("USD");


        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")

            ->setAmount($amount)
            ->setCustom('demo-1');

        $payment = new Payment();
        $payment->setIntent('sale');
        $redirectUrls = (new RedirectUrls())
            ->setReturnUrl('https://www.google.com')
            ->setCancelUrl('https://www.facebook.com');
        $payment->setRedirectUrls($redirectUrls);

        $payment->setPayer((new Payer())->setPaymentMethod('paypal'));

        $payment->setTransactions([$transaction]);

        try{
            $payment->create($apiContext);

            header('Location: '.$payment->getApprovalLink());
        // $this->redirect($payment->getApprovalLink());
        }catch (PayPalConnectionException $e){
            var_dump(json_decode($e->getData()));
        }

        die();
        //return new
    }

}
