<?php

namespace SoukElMedina\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findAll();

        $serialiser = new Serializer([new ObjectNormalizer()]);
        $formatted =$serialiser->normalize($produits);
        return new JsonResponse($formatted);
    }
}
