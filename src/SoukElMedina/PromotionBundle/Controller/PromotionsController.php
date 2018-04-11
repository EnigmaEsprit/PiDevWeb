<?php

namespace SoukElMedina\PromotionBundle\Controller;

use DateTime;
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
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $promotion = $em->getRepository('SoukElMedinaPidevBundle:Promotions')->findBy(array('iduser' => $this->getUser()->getId()));
        $paginator  = $this->get('knp_paginator');
        $promotions = $paginator->paginate(
            $promotion, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/
        );

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
        $em = $this->getDoctrine()->getManager();
        $promotion = new Promotions();
        $produit = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findProduit($this->getUser());

        $form = $this->createForm('SoukElMedina\PromotionBundle\Form\PromotionsType', $promotion);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('SoukElMedinaPidevBundle:Produits');
            $Produits = $repository->findOneBy(array('idproduit' => $request->get('produits')));
            $promotion->setIdproduit($Produits);




            $DD= DateTime::createFromFormat('d/m/Y H:i', $request->get('date-start'));
            $DF= DateTime::createFromFormat('d/m/Y H:i', $request->get('date-end'));

            $promotion->setDatedebut($DD);
            $promotion->setDatefin($DF);
            $Produits->setNewPrix(($Produits->getPrixproduit()-(($promotion->getPourcentage()/100)*$Produits->getPrixproduit())));
            $promotion->setIduser($this->getUser());
            $Produits->setValid(1);
            $users=$em->getRepository('SoukElMedinaPidevBundle:Users')->FindUsers();



            $em->persist($promotion);
            $em->flush();
            $Produits->setIdpromotion($promotion);

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
            'produits'=>$produit
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
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($promotion);
        $editForm = $this->createForm('SoukElMedina\PromotionBundle\Form\PromotionsType', $promotion);
        $produit = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findProduit($this->getUser());
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('SoukElMedinaPidevBundle:Produits');
            $Produits = $repository->findOneBy(array('idproduit' => $request->get('produits')));
            $promotion->setIdproduit($Produits);
            $DD= DateTime::createFromFormat('d/m/Y H:i', $request->get('date-start'));
            $DF= DateTime::createFromFormat('d/m/Y H:i', $request->get('date-end'));

            $promotion->setDatedebut($DD);
            $promotion->setDatefin($DF);
            $Produits->setNewPrix(($Produits->getPrixproduit()-(($promotion->getPourcentage()/100)*$Produits->getPrixproduit())));
            $promotion->setIduser($this->getUser());
            $em->persist($promotion);
            $em->flush();


            return $this->redirectToRoute('promotions_index');
        }

        return $this->render('@SoukElMedinaPromotion/promotions/edit.html.twig', array(
            'promotion' => $promotion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'produits'=>$produit
        ));
    }
    public function deleteAction(Promotions $promotions)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $Prosuits = $EM->getRepository('SoukElMedinaPidevBundle:Produits')->findProduit($promotions->getIdproduit());
        $Prosuits->setNewPrix(NULL);
        $Prosuits->setValid(NULL);
        $Promotion = $EM->getRepository("SoukElMedinaPidevBundle:Promotions")->find($promotions->getIdproduit());
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
    public function indexINCAction(Request $request)
    {
//        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();

        $promotions = $em->getRepository('SoukElMedinaPidevBundle:Promotions')->findAll();
        $paginator  = $this->get('knp_paginator');
        $prompotions1 = $paginator->paginate(
            $promotions, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );

        $DC=(new \DateTime('now'))->format("d/m/Y H:i");
        $prompotion2 =$em->getRepository('SoukElMedinaPidevBundle:Promotions')->FindOffers($DC);
        $paginator  = $this->get('knp_paginator');
        $prompotions2 = $paginator->paginate(
            $prompotion2, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );


        return $this->render('@SoukElMedinaPromotion/promotions/promotionINC.html.twig', array(
            'promotions' => $prompotions1,'promotionsO'=>$prompotions2,
        ));
    }
    public function findProduitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findOneBy(array('nomproduit'=>$request->get('produitv')));
        $serializer = SerializerBuilder::create()->build();
        $response = $serializer->serialize($user, 'json');
        return new JsonResponse($response);
    }

}
