<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategorieController extends Controller
{
    public function beveragesAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:beverages.html.twig');
    }
    public function groceriesAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:groceries.html.twig');
    }
}
