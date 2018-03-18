<?php

namespace SoukElMedina\PanierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaPanierBundle:Default:index.html.twig');
    }
}
