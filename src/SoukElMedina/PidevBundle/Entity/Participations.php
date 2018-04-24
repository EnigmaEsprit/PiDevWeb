<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participations
 *
 * @ORM\Table(name="participations", uniqueConstraints={@ORM\UniqueConstraint(name="idUser", columns={"idUser", "idEvenement"})}, indexes={@ORM\Index(name="IDX_FDC6C6E8F7CC4348", columns={"idEvenement"}), @ORM\Index(name="IDX_FDC6C6E8FE6E88D7", columns={"idUser"})})
 * @ORM\Entity
 */
class Participations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var \Evenements
     *
     * @ORM\ManyToOne(targetEntity="Evenements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvenement", referencedColumnName="idEvenement")
     * })
     */
    private $idevenement;

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

