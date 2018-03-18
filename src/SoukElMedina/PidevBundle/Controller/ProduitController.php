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
        return $this->render('SoukElMedinaPidevBundle:Default:detail.html.twig');
    }
}
