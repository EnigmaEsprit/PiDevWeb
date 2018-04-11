<?php

namespace SoukElMedina\PanierBundle\Repository;

/**
 * panierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class panierRepository extends \Doctrine\ORM\EntityRepository
{
    public function findProduitInSessionArray($array){
        $query = $this->createQueryBuilder('p');
        $query->where('p.idproduit IN (:array)')
            ->setParameter('array',$array);
        return $query->getQuery()->getResult();
    }

    public function findIdCmdTab($idTransaction){

        $em = $this->getEntityManager()
            ->createQuery("select m.idcommande from SoukElMedinaPidevBundle:Commandes m
                        where m.idtransaction = :idTransaction ")
                    ->setParameter('idTransaction',$idTransaction);
        return $em->getResult();
    }
    public function stats(){
        $em = $this->getEntityManager()
                ->createQuery("SELECT SUM(L.quantite), P.nomproduit
                                  from SoukElMedinaPidevBundle:Lignecommandes L 
                                  JOIN SoukElMedinaPidevBundle:Produits P 
                                  WITH L.idproduit = P.idproduit 
                                  group by P.nomproduit");




        return $em->getResult();
    }
    public function GetStatistiqueDateVenteProduit($datevente)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT SUM(L.quantite), P.nomproduit 
                              from SoukElMedinaPidevBundle:Lignecommandes L 
                              JOIN SoukElMedinaPidevBundle:Produits P 
                             WITH L.idproduit = P.idproduit 
                              JOIN SoukElMedinaPidevBundle:Commandes C
                              WITH L.idcommande=C.idcommande 
                              WHERE C.datedecommande=:d 
                              GROUP BY P.nomproduit")
            ->setParameter('d',$datevente)
        ;
        return $query->getResult();
    }
    public function findIdCmd($array){
        $query = $this->createQueryBuilder('p');
        $query->where('p.idcommande IN (:array)')
            ->setParameter('array',$array);
        return $query->getQuery()->getResult();
    }

    public function byFacture($utilisateur){
        $query = $this->createQueryBuilder('u');
        $query->where('u.iduser =:utilisateur')
                ->andWhere('u.etat = 1')
                ->andWhere('u.reference !=0')
            ->orderBy('u.idcommande')
            ->setParameter('utilisateur',$utilisateur);
        return $query->getQuery()->getResult();}

    public function FindProduit($DC)

    {
        $query = $this->getEntityManager()->createQuery(

            "select m from  SoukElMedinaPidevBundle:Produits m ,SoukElMedinaPidevBundle:Magasins s WHERE  m.idmagasin= s.idmagasin and s.iduser=:x "

        )->setParameter('x',$DC);

        return $query->getResult();
    }
}