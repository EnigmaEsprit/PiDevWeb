<?php
/**
 * Created by PhpStorm.
 * User: Ivan Landry ONANA
 * Date: 05/04/2018
 * Time: 07:12
 */

namespace SoukElMedina\CommentairesBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CommentairesRepository extends EntityRepository
{
    public function findCommentaires($id) {
        $query = $this -> getEntityManager()
            -> createQuery("select v from SoukElMedinaPidevBundle:Commentaires v WHERE v.idproduit = :serie")
            -> setParameter('serie', $id);
        return $query -> getResult();
    }
}