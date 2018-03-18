<?php

namespace SoukElMedina\DecouverteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaDecouverteBundle:Default:index.html.twig');
    }
}
