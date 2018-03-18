<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class faqController extends Controller
{
    public function faqAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:faq.html.twig');
    }
}
