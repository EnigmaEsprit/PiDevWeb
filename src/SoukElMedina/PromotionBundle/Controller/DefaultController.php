<?php

namespace SoukElMedina\PromotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaPromotionBundle:Default:index2.html.twig');
    }
}
