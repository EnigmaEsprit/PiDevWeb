<?php

namespace SoukElMedina\PromotionBundle\Controller;

use JMS\Serializer\SerializerBuilder;
use SoukElMedina\PidevBundle\Entity\Promotions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Promotion controller.
 *
 */
class PromotionsController extends Controller
{
    /**
     * Lists all promotion entities.
     *
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $promotions = $em->getRepository('SoukElMedinaPidevBundle:Promotions')->findBy(array('iduser' => $this->getUser()->getId()));

        return $this->render('@SoukElMedinaPromotion/promotions/index.html.twig', array(
            'promotions' => $promotions,
        ));
    }

    /**
     * Creates a new promotion entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $promotion = new Promotions();
        $form = $this->createForm('SoukElMedina\PromotionBundle\Form\PromotionsType', $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            var_dump(($promotion->getPourcentage()/100)*$promotion->getIdproduit()->getPrixproduit());

            $em = $this->getDoctrine()->getManager();
//            var_dump($promotion->getPourcentage());

            $promotion->setDatedebut($request->get('date-start'));
            $promotion->setDatefin($request->get('date-end'));
            $promotion->setNewPrix(($promotion->getIdproduit()->getPrixproduit()-(($promotion->getPourcentage()/100)*$promotion->getIdproduit()->getPrixproduit())));
            $promotion->setIduser($this->getUser());
            $users=$em->getRepository('SoukElMedinaPidevBundle:Users')->FindUsers();

            $em->persist($promotion);
            $em->flush();
            foreach ($users as $user) {

                $message = \Swift_Message::newInstance()
                    ->setSubject('Events')
                    ->setFrom('boumaiazaoussama@gmail.com')
                    ->setTo($user->getEmail())
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody('test');
                $this->get('mailer')->send($message);


            }

            return $this->redirectToRoute('promotions_show', array('idpromotion' => $promotion->getIdpromotion()));
        }

        return $this->render('SoukElMedinaPromotionBundle:promotions:new.html.twig', array(
            'promotion' => $promotion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a promotion entity.
     *
     */
    public function showAction(Promotions $promotion)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $deleteForm = $this->createDeleteForm($promotion);

        return $this->render('@SoukElMedinaPromotion/promotions/show.html.twig', array(
            'promotion' => $promotion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing promotion entity.
     *
     */
    public function editAction(Request $request, Promotions $promotion)
    {
        $deleteForm = $this->createDeleteForm($promotion);
        $editForm = $this->createForm('SoukElMedina\PromotionBundle\Form\PromotionsType', $promotion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $promotion->setDatedebut($request->get('date-start'));
            $promotion->setDatefin($request->get('date-end'));
            $promotion->setNewPrix(($promotion->getIdproduit()->getPrixproduit()-(($promotion->getPourcentage()/100)*$promotion->getIdproduit()->getPrixproduit())));
            $promotion->setIduser($this->getUser());
            $em->persist($promotion);
            $em->flush();

            return $this->redirectToRoute('promotions_index');
        }

        return $this->render('@SoukElMedinaPromotion/promotions/edit.html.twig', array(
            'promotion' => $promotion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function deleteAction($idpromotion)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $Promotion = $EM->getRepository("SoukElMedinaPidevBundle:Promotions")->find($idpromotion);
        $EM->remove($Promotion);
        $EM->flush();
        return $this->redirectToRoute('promotions_index');
    }

//    /**
//     * Deletes a promotion entity.
//     *
//     */
//    public function deleteAction(Request $request, Promotions $promotion)
//    {
//        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
//        $form = $this->createDeleteForm($promotion);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($promotion);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('promotions_index');
//    }

    /**
     * Creates a form to delete a promotion entity.
     *
     * @param Promotions $promotion The promotion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Promotions $promotion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('promotions_delete', array('idpromotion' => $promotion->getIdpromotion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function indexINCAction()
    {
//        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $promotions = $em->getRepository('SoukElMedinaPidevBundle:Promotions')->findAll();
        $DC=(new \DateTime('now'))->format("d/m/Y H:i");
        $prompotion2 =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->FindOffers($DC);

        return $this->render('@SoukElMedinaPromotion/promotions/promotionINC.html.twig', array(
            'promotions' => $promotions,'promotionsO'=>$prompotion2,
        ));
    }
    public function findProduitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        var_dump($request->get('produitv'));

        $user = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findOneBy(array('nomproduit'=>$request->get('produitv')));
        $serializer = SerializerBuilder::create()->build();
        $response = $serializer->serialize($user, 'json');
        return new JsonResponse($response);
    }

//    public function PrixAjaxAction(Request $request)
//    {
//        $voiture = new Voiture();
//        $em = $this->getDoctrine()->getManager();
//        $voitures = $em->getRepository('EspritParcBundle:Voiture')->findAll();
//
//        if($request->isXmlHttpRequest())
//        {
//            $serializer = new Serializer(array(new ObjectNormalizer()));
//            $voitures=$em->getRepository('EspritParcBundle:Voiture')
//                ->findSerieDql($request->get('serie'));
//            // var_dump($voitures);
//            $data = $serializer->normalize($voitures);
//            return new JsonResponse($data);
//        }
//        return $this->render(
//            'EspritParcBundle:Voiture:RechercheAjax.html.twig',
//            array("voitures"=>$voitures,
//                "form" =>$Form->createView())
//        );
//    }
}
