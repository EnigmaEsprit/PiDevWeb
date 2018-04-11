<?php

namespace SoukElMedina\PidevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED') and $this->isGranted('ROLE_VENDEUR')) {

            return $this->redirectToRoute('souk_el_medina_pidev_homepage_Vendeur');
        }
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED') and $this->isGranted('ROLE_USER')) {
            $em = $this->getDoctrine()->getManager();
//        $time = new \DateTime();
//        $time->format('Y-m-d');
            $DC=(new \DateTime('now'))->format("d/m/Y H:i");
            var_dump($DC);

            $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);

            return $this->render('@SoukElMedinaPidev/Default/index.html.twig', array(
                'evenements' => $evenements,
            ));

        }
        $em = $this->getDoctrine()->getManager();
//        $time = new \DateTime();
//        $time->format('Y-m-d');
        $DC=(new \DateTime('now'))->format("d/m/Y H:i");
        var_dump($DC);

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->FindEvenement($DC);

        return $this->render('@SoukElMedinaPidev/Default/index.html.twig', array(
            'evenements' => $evenements,
        ));

    }
    public function indexVendeurAction()
    {
        $userID = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('SoukElMedinaPidevBundle:Evenements')->findBy(array('iduser'=>$userID));

        return $this->render('@SoukElMedinaPidev/Default/indexVendeur.html.twig', array(
            'evenements' => $evenements,
        ));

    }
    public function indexAdminAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:indexAdmin.html.twig');
    }
    public function indexClientAction()
    {
        return $this->render('SoukElMedinaPidevBundle:Default:Client.html.twig');
    }

}
