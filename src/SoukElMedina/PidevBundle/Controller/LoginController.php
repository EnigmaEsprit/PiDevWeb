<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function LoginAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:login.html.twig');
    }
    public function registeredAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:registered.html.twig');
    }


}
