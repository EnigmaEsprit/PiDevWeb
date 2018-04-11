<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30/03/2018
 * Time: 13:18
 */

namespace SoukElMedina\DecouverteBundle\Repository;
use Doctrine\ORM\EntityRepository ;


class ContactRepository extends EntityRepository
{
    public function findContactDql($name)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Magasins m , SoukElMedinaPidevBundle:Users e WHERE (e.nom LIKE  :x or m.nommagasin LIKE  :x or e.email LIKE :x)and( m.iduser = e.id)  "

        )->setParameter('x','%'.$name.'%');

        return $query->getResult();
    }

    public function findMagasinID($idVendeur) {
        $query = $this -> getEntityManager()
            -> createQuery("select v.idmagasin from SoukElMedinaPidevBundle:Magasins v WHERE v.iduser = :serie")
            -> setParameter('serie', $idVendeur);
        return $query -> getResult();
    }


}