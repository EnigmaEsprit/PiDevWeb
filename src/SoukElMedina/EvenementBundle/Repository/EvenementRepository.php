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
//        $query = $this->createQueryBuilder("m");
//        $query->where(
//            $query->expr()->gte(':x','m.datefin')
//        )
//            ->setParameter('x',$DC);
//
//        return $query->getQuery()->getResult();
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Evenements m WHERE (m.datefin>=:x) and m.verifier =1 "

        )->setParameter('x',$DC);

        return $query->getResult();
    }

    public function FindDql($nom)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Evenements m WHERE m.nomevenement=:x "

        )->setParameter('x','%'.$nom.'%');

        return $query->getResult();
    }
    public function findEventRequestDql($nom)
    {
        $query = $this->createQueryBuilder("m");
        $query->where(
            $query->expr()->like('m.nomevenement',':x'),
            $query->expr()->eq('m.verifier',0)
            )
       ->orderBy('m.date')
            ->setParameter('x','%'.$nom.'%');

        return $query->getQuery()->getResult();
//        $query=$this->getEntityManager()
//            ->createQuery("Select v From SoukElMedinaPidevBundle:Evenements v
//              WHERE  v.nomevenement LIKE :nom  ORDER BY v.date")
//            ->setParameter('nom','%'.$nom.'%');
//        return $query->getResult();
    }
//    public function FindAjax($nom)
//
//    {
//        $query = $this->getEntityManager()->createQuery(
//
//            "select m from  SoukElMedinaPidevBundle:Evenements m ,SoukElMedinaPidevBundle:Users u WHERE m.nomevenement=:x or u.name =:x or u.prenom =:x and u.id = m.id   "
//
//        )->setParameter('x','%'.$nom.'%');
//
//        return $query->getResult();
//    }
    public function findEventBlockDql($nom)
    {
        $query = $this->createQueryBuilder("m");
        $query->where(
            $query->expr()->like('m.nomevenement', ':x'),
            $query->expr()->eq('m.verifier', 3)
        )
            ->orderBy('m.date')
            ->setParameter('x', '%' . $nom . '%');

        return $query->getQuery()->getResult();
    }
    public function findEventDql($nom)
    {
        $query = $this->createQueryBuilder("m");
        $query->where(
            $query->expr()->like('m.nomevenement', ':x'),
            $query->expr()->eq('m.verifier', 1)
        )
            ->orderBy('m.date')
            ->setParameter('x', '%' . $nom . '%');

        return $query->getQuery()->getResult();
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


    public function SelectListParticipant($user)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Participations m , SoukElMedinaPidevBundle:Evenements e WHERE e.iduser =:x and m.idevenement = e.id GROUP BY m.idevenement "

        )->setParameter('x',$user);

        return $query->getResult();
    }

    public function SelectListParticipantEvnt($id)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Participations m  WHERE m.idevenement =:x GROUP BY m.idevenement "

        )->setParameter('x',$id);

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

}