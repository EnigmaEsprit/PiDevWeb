<?php

namespace SoukElMedina\CommentairesBundle\Controller;

use SoukElMedina\CommentairesBundle\SoukElMedinaCommentairesBundle;
use SoukElMedina\PidevBundle\Entity\Commentaires;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentairesController extends Controller
{
    /***************     Fonctions  Clients   *******************/

    public function ajouterUnCommentaireAction(Request $request)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $commentaire = new Commentaires();
        $commentaires = $em -> getRepository('SoukElMedinaPidevBundle:Commentaires') -> findCommentaires(1);
        $currentDateTime = (new \DateTime('now'))->format("Y-m-d H:i:s");
        $user = $em->getRepository('SoukElMedinaPidevBundle:Users') -> find($this->getUser());
        $form = $this->createForm('SoukElMedina\CommentairesBundle\Form\CommentairesType',$commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produit = $em->getRepository('SoukElMedinaPidevBundle:Produits')->find(1);
            $commentaire->setIduser($this->getUser());
            $commentaire->setDateajoutcommentaire(date_create($currentDateTime));
            //$commentaire->setContenucommentaire($request->get('textqrq'));
            $commentaire->setIdproduit($produit);
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('souk_el_medina_pidev_detail');
        }
        return $this->render('SoukElMedinaPidevBundle:Default:detail.html.twig',array(
            'commentaires' => $commentaires, 'user' => $user
        ));
    }
            //

    public function deleteCommentaireAction($id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('SoukElMedinaPidevBundle:Commentaires')->find($id);

        if($this->getUser() == $commentaire->getIduser()){
            $em->remove($commentaire);
            $em->flush();
            return $this->redirectToRoute('souk_el_medina_pidev_detail');
        }
        else{
            $erreur = "Access denied. Vous n'avez pas l'autorisation de supprimer ce commentaire!";
            return new Response($erreur);
        }
    }

}
