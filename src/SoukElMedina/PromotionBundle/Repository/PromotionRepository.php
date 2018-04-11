<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27/03/2018
 * Time: 20:23
 */

namespace SoukElMedina\PromotionBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PromotionRepository extends EntityRepository
{
    public function FindOffers($DC)

    {
        $query = $this->createQueryBuilder("m");
        $query->where(
            $query->expr()->between(':x','m.datedebut','m.datefin'
            ))
        ->setParameter('x',$DC);

        return $query->getQuery()->getResult();


//        $query = $this->createQueryBuilder("m");
//        $query->where($query->expr()->andX($query->expr()->gt(':x','m.datedebut'),
//            $query->expr()->lt(':x','m.datefin')))
//            ->setParameter('x',$DC);

//        $query = $this->getEntityManager()->createQuery(
//
//            "select m from  SoukElMedinaPidevBundle:Promotions m WHERE  m.datedebut<=:x  and m.datefin>=:x  "
//
//        )->setParameter('x',$DC);
//
//        return $query->getResult();
    }
    public function FindOffresEX($DC)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Promotions m WHERE m.datefin<:x "

        )->setParameter('x',$DC);

        return $query->getResult();
    }
    public function FindAllOffresEX()

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Promotions m, SoukElMedinaPidevBundle:Produits p WHERE m.idproduit=p.idproduit and p.valid=1 "

        );
        return $query->getResult();
    }
}