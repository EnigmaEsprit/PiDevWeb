<?php

namespace SoukElMedina\DecouverteBundle\Controller;


use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction( Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $magasins = $em->getRepository('SoukElMedinaPidevBundle:Magasins')->findAll();
        $paginator  = $this->get('knp_paginator');
        $magasins = $paginator->paginate(
            $magasins, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/
        );

        if($request->isMethod('post')){
            $message = \Swift_Message::newInstance()
                ->setSubject('Contact(USER)')
                ->setFrom($request->get('email'))
                ->setTo('boumaiazaoussama@gmail.com')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->render('@SoukElMedinaDecouverte/Decouverte/emailContact.html.twig', array('name' => $request->get('name'), 'body' => $request->get('body'))));
            $this->get('mailer')->send($message);
            return $this->render('@SoukElMedinaDecouverte/Decouverte/contact.html.twig', array(
                'magasins' => $magasins, ));

        }
        return $this->render('@SoukElMedinaDecouverte/Decouverte/contact.html.twig', array(
            'magasins' => $magasins,
        ));

    }
    public function contactVendeurAction( Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $magasins = $em->getRepository('SoukElMedinaPidevBundle:Magasins')->findAll();
        $paginator  = $this->get('knp_paginator');
        $magasins = $paginator->paginate(
            $magasins, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/
        );
        return $this->render('@SoukElMedinaDecouverte/Decouverte/contactVendeur.html.twig', array(
            'magasins' => $magasins,
        ));

    }
    public function SearchAction($name,Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository('SoukElMedinaPidevBundle:Magasins')->findContactDql($name);
        $serializer = SerializerBuilder::create()->build();
        $response = $serializer->serialize($user,'json');
        return new JsonResponse($response);

    }
//    public function SendEmailAction(Request $request)
//    {
//
//        $from=$request->get('email');
//        $name=$request->get('name');
//        $body=$request->get('body');
//        var_dump($from);
//        var_dump($name);
//        var_dump($body);
//
//
//
//        $message = \Swift_Message::newInstance()
//                ->setSubject('Contact(USER)')
//                ->setFrom($request->get('email'))
//                ->setTo('boumaiazaoussama@gmail.com')
//                ->setCharset('utf-8')
//                ->setContentType('text/html')
//                ->setBody($this->render('@SoukElMedinaDecouverte/Decouverte/emailContact.html.twig', array('name' => $request->get('name'), 'body' => $request->get('body'))));
//            $this->get('mailer')->send($message);
//        return $this->render('@SoukElMedinaDecouverte/Decouverte/contact.html.twig');
//
//    }

}
