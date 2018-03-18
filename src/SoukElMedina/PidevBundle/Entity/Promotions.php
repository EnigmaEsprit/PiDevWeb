<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotions
 *
 * @ORM\Table(name="promotions", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="IdProduit", columns={"IdProduit"})})
 * @ORM\Entity
 */
class Promotions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPromotion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpromotion;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPromotion", type="string", length=50, nullable=false)
     */
    private $nompromotion;

    /**
     * @var string
     *
     * @ORM\Column(name="imagePromotion", type="string", length=50, nullable=false)
     */
    private $imagepromotion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;

    /**
     * @var \Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdProduit", referencedColumnName="idProduit")
     * })
     */
    private $idproduit;


}

