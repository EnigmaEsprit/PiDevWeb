<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenements
 *
 * @ORM\Table(name="evenements")
 * @ORM\Entity
 */
class Evenements
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEvenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvenement", type="string", length=50, nullable=false)
     */
    private $nomevenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreDePlaces", type="integer", nullable=false)
     */
    private $nombredeplaces;

    /**
     * @var float
     *
     * @ORM\Column(name="tarifEvenement", type="float", precision=10, scale=0, nullable=false)
     */
    private $tarifevenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="descriptionEvenement", type="integer", nullable=false)
     */
    private $descriptionevenement;


}

