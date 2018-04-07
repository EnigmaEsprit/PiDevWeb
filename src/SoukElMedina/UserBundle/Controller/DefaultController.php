<?php

namespace SoukElMedina\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaUserBundle:Default:index.html.twig');
    }
}
