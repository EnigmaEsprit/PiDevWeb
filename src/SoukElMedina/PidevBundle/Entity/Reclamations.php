<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="reclamations_ibfk_2", columns={"idMagasin"})})
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="typeReclamation", type="string", length=70, nullable=true)
     */
    private $typereclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="objetReclamation", type="string", length=100, nullable=true)
     */
    private $objetreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuReclamation", type="string", length=500, nullable=true)
     */
    private $contenureclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnvoiReclamation", type="date", nullable=true)
     */
    private $dateenvoireclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReponseReclamation", type="date", nullable=true)
     */
    private $datereponsereclamation;

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
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;


}

