<?php

namespace SoukElMedina\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaEvenementBundle:Default:index.html.twig');
    }
}
