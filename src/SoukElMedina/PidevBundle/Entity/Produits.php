<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="produits", indexes={@ORM\Index(name="idMagasin", columns={"idMagasin"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\PanierBundle\Repository\panierRepository")
 */
class Produits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="referenceProduit", type="integer", nullable=false)
     */
    private $referenceproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProduit", type="string", length=50, nullable=false)
     */
    private $nomproduit;

    /**
     * @var float
     *
     * @ORM\Column(name="prixProduit", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="photoProduit", type="string", length=50, nullable=false)
     */
    private $photoproduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantiteProduit", type="integer", nullable=false)
     */
    private $quantiteproduit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpromotion", type="integer", nullable=false)
     */
    private $idpromotion;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieMagasin", type="string", length=50, nullable=false)
     */
    private $categoriemagasin;

    /**
     * @var \Magasins
     *
     * @ORM\ManyToOne(targetEntity="Magasins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMagasin", referencedColumnName="idMagasin")
     * })
     */
    private $idmagasin;

    /**
     * Produits constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return int
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    /**
     * @param int $idproduit
     */
    public function setIdproduit($idproduit)
    {
        $this->idproduit = $idproduit;
    }

    /**
     * @return int
     */
    public function getReferenceproduit()
    {
        return $this->referenceproduit;
    }

    /**
     * @param int $referenceproduit
     */
    public function setReferenceproduit($referenceproduit)
    {
        $this->referenceproduit = $referenceproduit;
    }

    /**
     * @return string
     */
    public function getNomproduit()
    {
        return $this->nomproduit;
    }

    /**
     * @param string $nomproduit
     */
    public function setNomproduit($nomproduit)
    {
        $this->nomproduit = $nomproduit;
    }

    /**
     * @return float
     */
    public function getPrixproduit()
    {
        return $this->prixproduit;
    }

    /**
     * @param float $prixproduit
     */
    public function setPrixproduit($prixproduit)
    {
        $this->prixproduit = $prixproduit;
    }

    /**
     * @return string
     */
    public function getPhotoproduit()
    {
        return $this->photoproduit;
    }

    /**
     * @param string $photoproduit
     */
    public function setPhotoproduit($photoproduit)
    {
        $this->photoproduit = $photoproduit;
    }

    /**
     * @return int
     */
    public function getQuantiteproduit()
    {
        return $this->quantiteproduit;
    }

    /**
     * @param int $quantiteproduit
     */
    public function setQuantiteproduit($quantiteproduit)
    {
        $this->quantiteproduit = $quantiteproduit;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getIdpromotion()
    {
        return $this->idpromotion;
    }

    /**
     * @param int $idpromotion
     */
    public function setIdpromotion($idpromotion)
    {
        $this->idpromotion = $idpromotion;
    }

    /**
     * @return string
     */
    public function getCategoriemagasin()
    {
        return $this->categoriemagasin;
    }

    /**
     * @param string $categoriemagasin
     */
    public function setCategoriemagasin($categoriemagasin)
    {
        $this->categoriemagasin = $categoriemagasin;
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

