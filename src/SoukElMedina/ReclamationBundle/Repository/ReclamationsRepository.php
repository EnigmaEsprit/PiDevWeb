<?php
/**
 * Created by PhpStorm.
 * User: Ivan Landry ONANA
 * Date: 05/04/2018
 * Time: 07:03
 */

namespace SoukElMedina\ReclamationBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReclamationsRepository extends EntityRepository
{
    public function findReclamations($idMagasin) {
        $query = $this -> getEntityManager()
            -> createQuery("select v from SoukElMedinaPidevBundle:Reclamations v WHERE v.idmagasin = :idmagasin and 
              v.statusreclamation = 1 and v.datereponsereclamation is null ORDER by v.dateenvoireclamation desc ")
            -> setParameter('idmagasin', $idMagasin);
        return $query -> getResult();
    }

    public function printReclamations($idUser) {
        $query = $this -> getEntityManager()
            -> createQuery("select v from SoukElMedinaPidevBundle:Reclamations v WHERE v.iduser = :serie
              ORDER by v.dateenvoireclamation desc ")
            -> setParameter('serie', $idUser);
        return $query -> getResult();
    }

    public function findStatus() {
        $query = $this -> getEntityManager()
            -> createQuery("select v from SoukElMedinaPidevBundle:Reclamations v WHERE v.statusreclamation = 0");
        return $query -> getResult();
    }
/***********************  Recherches    ************************/

    public function findReclamationsParDateAdmin($jours) {
        $query = $this -> getEntityManager()
            -> createQuery("select v from SoukElMedinaPidevBundle:Reclamations v 
              WHERE ((v.statusreclamation = 0) and (CURRENT_TIME() - v.dateenvoireclamation <= :jours)) 
              ORDER by v.dateenvoireclamation desc ")
            -> setParameter('jours', $jours);
        return $query -> getResult();
    }

    public function findReclamationsParDate($idMagasin, $jours) {
        $query = $this -> getEntityManager()
            -> createQuery("select v from SoukElMedinaPidevBundle:Reclamations v WHERE ((v.idmagasin = :serie) and 
              (v.statusreclamation = 1) and (v.datereponsereclamation is null) and (CURRENT_TIME() - v.dateenvoireclamation <= :jours)) 
              ORDER by v.dateenvoireclamation desc ")
            -> setParameters(array(
                'serie' => $idMagasin,
                'jours' => $jours,
            ));
        return $query -> getResult();
    }

    public function findReclamationsParType($typeReclamation) {
        $query = $this -> getEntityManager()
            -> createQuery("select v from SoukElMedinaPidevBundle:Reclamations v 
              WHERE v.statusreclamation = 0 and v.typereclamation = :typee 
              ORDER by v.dateenvoireclamation desc ")
            -> setParameter('typee', $typeReclamation);
        return $query -> getResult();
    }

}