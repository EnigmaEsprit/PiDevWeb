<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23/03/2018
 * Time: 20:08
 */

namespace SoukElMedina\EvenementBundle\Repository;
use Doctrine\ORM\EntityRepository ;

class EvenementRepository extends EntityRepository
{
    public function FindEvenement($DC)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Evenements m WHERE (m.date>=:x) OR (m.datefin>=:x) "

        )->setParameter('x',$DC);

        return $query->getResult();
    }
    public function FindParticipation($event,$user)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Participations m WHERE (m.idevenement=:x) and (m.iduser=:y) "

        )->setParameter('x',$event)
         ->setParameter('y',$user);

        return $query->getResult();
    }
    public function UpdatePlace($id)

    {
//        $query = $this->getEntityManager()->createQuery(
//            "update SoukElMedinaPidevBundle:Evenements m set m.nombredesplacesrestante= (m.nombredesplacesrestante - 1)where m.id = :x"
//
////            "select m from  SoukElMedinaPidevBundle:Participations m WHERE (m.idevenement=:x) and (m.iduser=:y) "
//
//        )->setParameter('x',$id);
        $qb = $this->createQueryBuilder("u");
        $qb->update('SoukElMedinaPidevBundle:Evenements', 'u')
            ->set("u.nombredesplacesrestante", "u.nombredesplacesrestante -1")
            ->where("u.id = :id")
            ->setParameter("id", $id);

    }

}