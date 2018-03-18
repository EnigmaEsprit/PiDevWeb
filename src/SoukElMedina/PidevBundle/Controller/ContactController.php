<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function contactAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:contact.html.twig');
    }
}
