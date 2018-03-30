<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23/03/2018
 * Time: 20:08
 */

namespace SoukElMedina\EvenementBundle\Repository;
use Doctrine\ORM\EntityRepository ;
class ParticipationRepository extends EntityRepository
{
    public function SelectListParticipant($user)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m.* from  participations m , Evenements ,users u WHERE evenements.iduser =:x GROUP BY m.idEvenement "

        )->setParameter('x',$user);

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