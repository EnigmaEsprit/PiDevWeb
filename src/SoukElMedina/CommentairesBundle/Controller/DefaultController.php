<?php

namespace SoukElMedina\CommentairesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaCommentairesBundle:Default:index.html.twig');
    }
}
