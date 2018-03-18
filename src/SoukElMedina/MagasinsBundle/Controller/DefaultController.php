<?php

namespace SoukElMedina\MagasinsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaMagasinsBundle:Default:index.html.twig');
    }
}
