<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CommandeController extends Controller
{
    public function panierAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:panier.html.twig');
    }
}
