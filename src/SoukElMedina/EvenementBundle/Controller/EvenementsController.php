<?php

namespace SoukElMedina\EvenementBundle\Controller;

use DateTime;
use SoukElMedina\EvenementBundle\Form\RechercheAjaxType;
use SoukElMedina\PidevBundle\Entity\Evenements;
use SoukElMedina\PidevBundle\Entity\Participations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;



/**
 * Evenement controller.
 *
 */
class EvenementsController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     */
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('iduser' => $this->getUser()->getId()));
        $paginator  = $this->get('knp_paginator');
        $evenements = $paginator->paginate(
            $evenements, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('@SoukElMedinaEvenement/evenements/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }
    public function indexParticipantAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $participants = $em->getRepository('SoukElMedinaPidevBundle:Participations')->SelectListParticipant($this->getUser()->getId());
        $paginator  = $this->get('knp_paginator');
        $participants = $paginator->paginate(
            $participants, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
//        var_dump($this->getUser()->getId());
//        var_dump($participants);
        return $this->render('@SoukElMedinaEvenement/evenements/Participents.html.twig', array(
            'participants' => $participants,
        ));
    }
    public function indexParticipantevntAction(Evenements $evenements,Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
//        var_dump($evenements->getId());

        $participants = $em->getRepository('SoukElMedinaPidevBundle:Participations')->SelectListParticipantEvnt($evenements->getId());
        $paginator  = $this->get('knp_paginator');
        $participants = $paginator->paginate(
            $participants, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
//
//        var_dump($participants);
//        die();
        return $this->render('@SoukElMedinaEvenement/evenements/Participents.html.twig', array(
            'participants' => $participants,
        ));
    }
    public function indexAdminAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('verifier'=>1));
        $paginator  = $this->get('knp_paginator');
        $evenements = $paginator->paginate(
            $evenements, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('@SoukElMedinaEvenement/evenements/indexAdmin.html.twig', array(
            'evenements' => $evenements,
        ));
    }
    public function DemandeAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('verifier'=>0));
        $paginator  = $this->get('knp_paginator');
        $evenements = $paginator->paginate(
            $evenements, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('@SoukElMedinaEvenement/evenements/demande.html.twig', array(
            'evenements' => $evenements,
        ));
    }
    public function indexBlokAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('verifier'=>3));
        $paginator  = $this->get('knp_paginator');
        $evenements = $paginator->paginate(
            $evenements, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('@SoukElMedinaEvenement/evenements/ListeBlock.html.twig', array(
            'evenements' => $evenements,
        ));
    }
     public function SearchAction(Request $request)
     {
         $em = $this->getDoctrine()->getManager();
//         $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('verifier'=>1));
//         $paginator  = $this->get('knp_paginator');
//         $evenements = $paginator->paginate(
//             $evenements, /* query NOT result */
//             $request->query->getInt('page', 1)/*page number*/,
//             1/*limit per page*/
//         );
//         if ($request->get('name') != "")
//         {
             $user = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findEventDql($request->get('name'));
             $serializer = SerializerBuilder::create()->build();
             $response = $serializer->serialize($user, 'json');
             return new JsonResponse($response);
//         }

//         return $this->render('@SoukElMedinaEvenement/evenements/indexEventClient.html.twig', array(
//             'evenements' => $evenements,new JsonResponse(array())
//         ));



     }


    public function SearchRequestAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


//         $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findAll();
//         $paginator  = $this->get('knp_paginator');
//         $evenements = $paginator->paginate(
//             $evenements, /* query NOT result */
//             $request->query->getInt('page', 1)/*page number*/,
//             5/*limit per page*/
//         )
//         if(empty($request->get('name')))
//         {

//         $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findAll();
//         $paginator  = $this->get('knp_paginator');
//         $evenements = $paginator->paginate(
//             $evenements, /* query NOT result */
//             $request->query->getInt('page', 1)/*page number*/,
//             5/*limit per page*/
//         );
//
//         return $this->render('@SoukElMedinaEvenement/evenements/indexEventClient.html.twig', array(
//             'evenements' => $evenements
//         ));
//         }
//
//         elseif ($request->isXmlHttpRequest() ) {
//

        $user = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findEventRequestDql($request->get('name'));
        $serializer = SerializerBuilder::create()->build();
        $response = $serializer->serialize($user, 'json');
        return new JsonResponse($response);
//         }

    }
    public function SearchBlockAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();



        $user = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findEventBlockDql($request->get('name'));
        $serializer = SerializerBuilder::create()->build();
        $response = $serializer->serialize($user, 'json');
        return new JsonResponse($response);


    }




    public function indexEventClientAction(Request $request)
    {
//        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();


        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('verifier'=>1));
        $paginator  = $this->get('knp_paginator');
        $evenements = $paginator->paginate(
            $evenements, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/
        );

        return $this->render('@SoukElMedinaEvenement/evenements/indexEventClient.html.twig', array(
            'evenements' => $evenements
        ));
    }

    /**
     * Creates a new evenement entity.
     *
     */

    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $evenement = new Evenements();
        $form = $this->createForm('SoukElMedina\EvenementBundle\Form\EvenementsType', $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $evenement->setIduser($this->getUser());
            $evenement->setLieu($request->get('lieu'));
            $evenement->setNombredesplacesrestante($evenement->getNombredeplaces());
            $evenement->setDescriptionevenement($request->get('description'));
            $evenement->setDate($request->get('date-start'));
            $evenement->setDateFin($request->get('date-end'));
            $evenement->setVerifier(0);
            $subject=$evenement->getNomevenement();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenements_index');
        }

        return $this->render('@SoukElMedinaEvenement/evenements/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }
    public function AccepterAction(Evenements $evenements)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $evenements->setVerifier(1);
        $em->persist($evenements);
        $em->flush();
        $users=$em->getRepository('SoukElMedinaPidevBundle:Users')->FindUsers();

        foreach ($users as $user) {

            $message = \Swift_Message::newInstance()
                ->setSubject('Events')
                ->setFrom('boumaiazaoussama@gmail.com')
                ->setTo($user->getEmail())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->render('@SoukElMedinaEvenement/evenements/email.html.twig',array('name'=>$user->getNom(),'lieu'=>$evenements->getLieu(),'nameEvenement'=>$evenements->getNomevenement(),'datedubut'=>$evenements->getDate(),'datefin'=>$evenements->getDatefin(),'evenement'=>$evenements)));
            $this->get('mailer')->send($message);


        }

        return $this->redirectToRoute('evenements_demande');


    }
    public function UnlockAction(Evenements $evenements)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $evenements->setVerifier(1);
        $em->persist($evenements);
        $em->flush();
        $users=$em->getRepository('SoukElMedinaPidevBundle:Users')->FindUsers();

        foreach ($users as $user) {

            $message = \Swift_Message::newInstance()
                ->setSubject('Events')
                ->setFrom('boumaiazaoussama@gmail.com')
                ->setTo($user->getEmail())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->render('@SoukElMedinaEvenement/evenements/email.html.twig',array('name'=>$user->getNom(),'lieu'=>$evenements->getLieu(),'nameEvenement'=>$evenements->getNomevenement(),'datedubut'=>$evenements->getDate(),'datefin'=>$evenements->getDatefin(),'evenement'=>$evenements)));
            $this->get('mailer')->send($message);


        }

        return $this->redirectToRoute('evenements_Listblock');


    }
    public function RefuserAction(Evenements $evenements)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $evenements->setVerifier(2);
        $em->persist($evenements);
        $em->flush();

        return $this->redirectToRoute('evenements_demande');

//        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

    }
    public function BlockAction(Evenements $evenements)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $evenements->setVerifier(3);
        $em->persist($evenements);
        $em->flush();

        return $this->redirectToRoute('evenements_index_admin');
    }
    /**
     * //     * Finds and displays a evenement entity.
     * //     *
     * //     */
//    public function showAction(Evenements $evenement)
//    {
//        $deleteForm = $this->createDeleteForm($evenement);
//
//        return $this->render('@SoukElMedinaEvenement/evenements/show.html.twig', array(
//            'evenement' => $evenement,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    public function showAction(Evenements $evenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $DC = (new \DateTime('now'))->format("d/m/Y H:i");
        var_dump($DC);

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);

        return $this->render('SoukElMedinaEvenementBundle:evenements:show.html.twig', array(
            'evenement' => $evenement, 'evenements' => $evenements
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     */
    public function editAction(Request $request, Evenements $evenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('SoukElMedina\EvenementBundle\Form\EvenementsType', $evenement);
        $editForm->handleRequest($request);
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('SoukElMedinaPidevBundle:Evenements');
        $Event = $repository->findOneBy(array('id' => $evenement->getId()));
        $ver = $Event->getNombredeplaces();
        var_dump($ver);
        var_dump($request->get('nbp'));

        echo "llll";
        var_dump($evenement->getNombredesplacesrestante());



        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $evenement->setLieu($request->get('lieu'));
            $evenement->setDescriptionevenement($request->get('description'));
            $evenement->setDate($request->get('date-start'));
            $evenement->setDateFin($request->get('date-end'));
            var_dump($request->get('nbp'));
            var_dump($evenement->getNombredesplacesrestante());
            var_dump($evenement->getNombredesplacesrestante()+($evenement->getNombredeplaces()-(int)$request->get('nbp')));
            $rest=$evenement->getNombredesplacesrestante()+($evenement->getNombredeplaces()-(int)$request->get('nbp'));
            var_dump((int)$request->get('nbp')>$evenement->getNombredeplaces());
            var_dump($evenement->getNombredesplacesrestante()==0);
            var_dump($rest<0);

            if(((int)$request->get('nbp')>$evenement->getNombredeplaces()) && ($evenement->getNombredesplacesrestante()==0)||($rest<0))
            {
                return $this->redirectToRoute('evenements_edit', array('id' => $evenement->getId()));
            }
            else
            {
                $evenement->setNombredesplacesrestante($evenement->getNombredesplacesrestante()+($evenement->getNombredeplaces()-(int)$request->get('nbp')));
            }

            $evenement->setVerifier(0);
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenements_index', array('id' => $evenement->getId()));
        }

        return $this->render('@SoukElMedinaEvenement/evenements/edit.html.twig', array(
            'evenement' => $evenement,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($idevenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $Evenement = $EM->getRepository("SoukElMedinaPidevBundle:Evenements")->find($idevenement);
        $EM->remove($Evenement);
        $EM->flush();
        return $this->redirectToRoute('evenements_index');
    }
    public function deleteParticipantAction($id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $Participant = $EM->getRepository("SoukElMedinaPidevBundle:Participations")->find($id);
        $EM->remove($Participant);
        $EM->flush();
        return $this->redirectToRoute('evenements_index_sub');
    }

//    /**
//     * Deletes a evenement entity.
//     *
//     */
//    public function deleteAction(Request $request, Evenements $evenement)
//    {
//        $form = $this->createDeleteForm($evenement);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($evenement);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('evenements_index');
//    }
//
//    /**
//     * Creates a form to delete a evenement entity.
//     *
//     * @param Evenements $evenement The evenement entity
//     *
////     * @return \Symfony\Component\Form\Form The form
//     */
    private function createDeleteForm(Evenements $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenements_delete', array('idevenement' => $evenement->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


    public function affichermapAction($long, $lat)
    {

        return $this->render('@SoukElMedinaEvenement/evenements/map.html.twig', array('long' => $long, 'lat' => $lat));
    }

    public function subscribePageAction()
    {
        return $this->render('@SoukElMedinaEvenement/evenements/participation.html.twig');
    }

    public function subscribeAction(Request $request)
    {

        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $event = $request->get('idevenement');
        $user = $this->getUser();
        $Participent = $EM->getRepository("SoukElMedinaPidevBundle:Participations")->FindParticipation($event, $user);
        if (empty($Participent)&& $this->isGranted('ROLE_CLIENT')) {
            $Participer = new Participations();
            var_dump($request->get('idevenement'));
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('SoukElMedinaPidevBundle:Evenements');
            $Evenement = $repository->findOneBy(array('id' => $request->get('idevenement')));
            $Participer->setIdevenement($Evenement);
            $Participer->setIduser($this->getUser());
//            $EM->getRepository("SoukElMedinaPidevBundle:Evenements")->UpdatePlace($request->get('idevenement'));
            $EM->persist($Participer);
            $EM->flush();
            $Evenement->setNombredesplacesrestante(($Evenement->getNombredesplacesrestante())-1);
            $EM->persist($Evenement);
            $EM->flush();

            return $this->render("@SoukElMedinaEvenement/evenements/participation.html.twig");
        } elseif ($this->isGranted('ROLE_VENDEUR')) {
            $userID = $this->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $prompotion =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->findBy(array('iduser'=>$userID));

            $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('iduser'=>$userID));

            return $this->render('@SoukElMedinaPidev/Default/indexVendeur.html.twig', array(
                'evenements' => $evenements,'promotionsO'=>$prompotion,
            ));
        }else{
            return $this->render("@SoukElMedinaEvenement/evenements/echec.html.twig");
        }
    }

    public function showINCAction(Evenements $evenement)
    {

        $em = $this->getDoctrine()->getManager();
//        $time = new \DateTime();
//        $time->format('Y-m-d');
        $DC = (new \DateTime('now'));
        $DC2=(new \DateTime('now'))->format("d/m/Y H:i");

//        var_dump($DC);
        $NPR=$evenement->getNombredesplacesrestante();
        $DD=$evenement->getDate();
        $DF=$evenement->getDatefin();
        $D= DateTime::createFromFormat('d/m/Y H:i', $DD);
        $D2= DateTime::createFromFormat('d/m/Y H:i', $DF);
        var_dump($D);
        var_dump("-----------------------------");
        var_dump($D2);
        $plan=("http://www.localhost/pidevweb/web/");

        if($DC<=$D)
            {
                $var=true;
            }
            else
            {
                $var=false;
            }
            var_dump($var);
        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC2);

        return $this->render('SoukElMedinaEvenementBundle:evenements:showINC.html.twig', array(
            'evenement' => $evenement, 'evenements' => $evenements,'var'=>$var,'npr'=>$NPR,'p'=>$plan
        ));
    }
    public function showAdminAction(Evenements $evenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $DC = (new \DateTime('now'))->format("d/m/Y H:i");
        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);

        return $this->render('SoukElMedinaEvenementBundle:evenements:showAdmin.html.twig', array(
            'evenement' => $evenement, 'evenements' => $evenements
        ));
    }
    public function deleteAdminAction($idevenement)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $Evenement = $EM->getRepository("SoukElMedinaPidevBundle:Evenements")->find($idevenement);
        $EM->remove($Evenement);
        $EM->flush();
        return $this->redirectToRoute('evenements_index_admin');
    }
    public function rechercheAjaxDqlAction(Request $request)
    {
        $Evenement = new Evenements();
        $em = $this->getDoctrine()->getManager();
        $Evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findAll();
        $Form = $this->createForm(RechercheAjaxType::class,$Evenement);
        $Form->handleRequest($request);
        if($request->isXmlHttpRequest())
        {
            $serializer = new Serializer(array(new ObjectNormalizer()));
            $Evenements=$em->getRepository('SoukElMedinaPidevBundle:Evenements')
                ->findDql($request->get('chercher'));
            var_dump($Evenements);
            var_dump($request->get('chercher'));
            // var_dump($voitures);
            $data = $serializer->normalize($Evenements);
            return new JsonResponse($data);
        }
        return $this->render(
            '@SoukElMedinaEvenement/evenements/indexAdmin.html.twig',
            array("evenements"=>$Evenements,
                "form" =>$Form->createView())
        );
    }
    public function PDFParticiapantsAction(Evenements $evenements,Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
//        var_dump($evenements->getId());

        $Participent = $em->getRepository('SoukElMedinaPidevBundle:Participations')->SelectListParticipantEvnt($evenements->getId());
        if (!$Participent) {
            return $this->redirectToRoute('evenements_index');
        }

        $html = $this->renderView('SoukElMedinaEvenementBundle:evenements:pdfParticipants.html.twig',array(
            'Particiapants'=>$Participent,'Evenement'=>$evenements));

        try{
            $pdf = new \HTML2PDF('P','A4','fr');
            $pdf->pdf->SetAuthor('SoukElMedina');
            $pdf->pdf->SetTitle('Participant ');
            $pdf->pdf->SetSubject('Participant SoukElMedina');
            $pdf->pdf->SetKeywords('Participant,soukelmedina');
            $pdf->pdf->SetDisplayMode('real');
            $pdf->writeHTML($html);
            $pdf->Output('Participant.pdf');


//require 'phpmailer.php';

        }catch(\HTML2PDF_exception $e){
            die($e);
        }

        $response = new Response();
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;
    }


//    public function sendMailAction(Request $request)
//    {
//        if($request->getMethod()=="POST")
//        {
//            $Subject=$request->get()
//        }
//    }
}
