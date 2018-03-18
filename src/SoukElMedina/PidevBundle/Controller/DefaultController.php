<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:index.html.twig');
    }
    public function indexAdminAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:indexAdmin.html.twig');
    }
    public function indexClientAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:Client.html.twig');
    }
    public function indexVendeurAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:Vendeur.html.twig');
    }
}
