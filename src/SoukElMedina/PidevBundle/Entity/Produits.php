<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produits
 *
 * @ORM\Table(name="produits", indexes={@ORM\Index(name="idMagasin", columns={"idMagasin"})})
 * @ORM\Entity
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
    private $referenceproduit = '0';

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
    private $active = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idpromotion", type="integer", nullable=false)
     */
    private $idpromotion = '0';

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


}

