<?php

namespace SoukElMedina\ReclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaReclamationBundle:Default:index2.html.twig');
    }
}
