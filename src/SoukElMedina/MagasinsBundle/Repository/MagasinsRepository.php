<?php
/**
 * Created by PhpStorm.
 * User: Ivan Landry ONANA
 * Date: 05/04/2018
 * Time: 07:12
 */

namespace SoukElMedina\MagasinsBundle\Repository;


use Doctrine\ORM\EntityRepository;

class MagasinsRepository extends EntityRepository
{
    public function findMagasinID($idVendeur) {
        $query = $this -> getEntityManager()
            -> createQuery("select v.idmagasin from SoukElMedinaPidevBundle:Magasins v WHERE v.iduser = :serie")
            -> setParameter('serie', $idVendeur);
        return $query -> getResult();
    }
}