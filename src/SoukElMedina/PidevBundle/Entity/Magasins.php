<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magasins
 *
 * @ORM\Table(name="magasins", indexes={@ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 */
class Magasins
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMagasin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="nomMagasin", type="string", length=50, nullable=false)
     */
    private $nommagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="photoMagasin", type="string", length=50, nullable=false)
     */
    private $photomagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionMagasin", type="string", length=50, nullable=false)
     */
    private $descriptionmagasin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreationMagasin", type="date", nullable=false)
     */
    private $datecreationmagasin;

    /**
     * @var string
     *
     * @ORM\Column(name="contactMagasin", type="string", length=50, nullable=false)
     */
    private $contactmagasin;

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

