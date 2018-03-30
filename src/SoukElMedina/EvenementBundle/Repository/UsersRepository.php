<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/03/2018
 * Time: 13:21
 */

namespace SoukElMedina\EvenementBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    public function FindUsers()
    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Users m WHERE m.roles LIKE '%ROLE_CLIENT%' "

        );

        return $query->getResult();

    }


}