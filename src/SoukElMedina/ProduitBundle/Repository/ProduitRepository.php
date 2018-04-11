<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 08/04/2018
 * Time: 12:13
 */

namespace SoukElMedina\ProduitBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProduitRepository extends EntityRepository
{
    public function findProduitByPrice($price)
    {
        $query = $this->getEntityManager()
            ->createQuery("select p from
               SoukElMedinaPidevBundle:Produits p where p.prixproduit <= $price
               ");

        return $query->getResult();
    }
}