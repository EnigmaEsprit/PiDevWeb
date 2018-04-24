<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProduitController extends Controller
{
    public function produitAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:produit.html.twig');
    }
    public function detailAction()
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $commentaires = $em -> getRepository('SoukElMedinaPidevBundle:Commentaires') -> findCommentaires(1);
        $user = $em->getRepository('SoukElMedinaPidevBundle:Users') -> find($this->getUser());
        return $this->render('SoukElMedinaPidevBundle:Default:detail.html.twig',array(
            'commentaires' => $commentaires, 'user' => $user
        ));
    }
}
