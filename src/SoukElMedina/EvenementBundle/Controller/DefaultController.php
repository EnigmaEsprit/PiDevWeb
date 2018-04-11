<?php

namespace SoukElMedina\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoukElMedinaEvenementBundle:Default:index2.html.twig');
    }
    // when the user is mandatory (e.g. behind a firewall)
    public function fooAction(UserInterface $user)
    {
        $userId = $user->getId();
    }

    // when the user is optional (e.g. can be anonymous)
    public function barAction(UserInterface $user = null)
    {
        $userId = null !== $user ? $user->getId() : null;
    }
}
