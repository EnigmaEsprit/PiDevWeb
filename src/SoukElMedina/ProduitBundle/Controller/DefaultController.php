<?php

namespace SoukElMedina\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaProduitBundle:Default:index.html.twig');
    }
}
