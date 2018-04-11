<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignecommandes
 *
 * @ORM\Table(name="lignecommandes", indexes={@ORM\Index(name="idCommande", columns={"idCommande"}), @ORM\Index(name="idMagasin", columns={"idMagasin"}), @ORM\Index(name="idProduit", columns={"idProduit"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\PanierBundle\Repository\panierRepository")
 */
class Lignecommandes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLigneCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlignecommande;

    /**
     * @var float
     *
     * @ORM\Column(name="prixTotal", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixtotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prixUnitaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixunitaire;

    /**
     * @var \Produits
     *   @ORM\Column(name="idProduit")
     */
    private $idproduit;

    /**
     * @var \Commandes
     *   @ORM\Column(name="idCommande")
     */
    private $idcommande;

    /**
     * @var \Magasins
     *   @ORM\Column(name="idMagasin")
     */
    private $idmagasin;

    /**
     * Lignecommandes constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getIdlignecommande()
    {
        return $this->idlignecommande;
    }

    /**
     * @param int $idlignecommande
     */
    public function setIdlignecommande($idlignecommande)
    {
        $this->idlignecommande = $idlignecommande;
    }

    /**
     * @return float
     */
    public function getPrixtotal()
    {
        return $this->prixtotal;
    }

    /**
     * @param float $prixtotal
     */
    public function setPrixtotal($prixtotal)
    {
        $this->prixtotal = $prixtotal;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @return float
     */
    public function getPrixunitaire()
    {
        return $this->prixunitaire;
    }

    /**
     * @param float $prixunitaire
     */
    public function setPrixunitaire($prixunitaire)
    {
        $this->prixunitaire = $prixunitaire;
    }

    /**
     * @return \Produits
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    /**
     * @param \Produits $idproduit
     */
    public function setIdproduit($idproduit)
    {
        $this->idproduit = $idproduit;
    }

    /**
     * Get idcommande
     * @return \SoukElMedina\PidevBundle\Entity\Commandes
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }

    /**
     *Set  idcommande
     * @param  $idcommande
     * @return Lignecommandes
     */
    public function setIdcommande($idcommande)
    {
        $this->idcommande = $idcommande;
    }

    /**
     * @return \Magasins
     */
    public function getIdmagasin()
    {
        return $this->idmagasin;
    }

    /**
     * @param \Magasins $idmagasin
     */
    public function setIdmagasin($idmagasin)
    {
        $this->idmagasin = $idmagasin;
    }




}

