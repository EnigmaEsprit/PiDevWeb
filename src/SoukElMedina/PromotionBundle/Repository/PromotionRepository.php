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
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Promotions m WHERE  (:x>=m.datedebut ) and (m.datefin>=:x ) "

        )->setParameter('x',$DC);

        return $query->getResult();
    }
}