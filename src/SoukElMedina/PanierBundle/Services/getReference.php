<?php

namespace SoukElMedina\PanierBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


class GetReference{


    /**
     * getReference constructor.
     */
    public function __construct($entityManager)
    {
        $this->em=$entityManager;
    }

    public function reference(){

        $reference = $this->em->getRepository('SoukElMedinaPidevBundle:Commandes')
                            ->findOneBy(array('etat' =>1),
                                        array('idcommande' =>'DESC'),1,1);

        if(!$reference)
            return 1;
        else
            return $reference->getReference()+1;
    }
}