<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="commentaires_ibfk_2", columns={"idProduit"})})
 * @ORM\Entity
 */
class Commentaires
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCommentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuCommentaire", type="string", length=2000, nullable=false)
     */
    private $contenucommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAjoutCommentaire", type="date", nullable=false)
     */
    private $dateajoutcommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModificationCommentaire", type="date", nullable=false)
     */
    private $datemodificationcommentaire;

    /**
     * @var \Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduit", referencedColumnName="idProduit")
     * })
     */
    private $idproduit;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;


}

