<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faqs
 *
 * @ORM\Table(name="faqs")
 * @ORM\Entity
 */
class Faqs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idFaq", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfaq;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuFaq", type="string", length=800, nullable=false)
     */
    private $contenufaq;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnvoiFaq", type="date", nullable=false)
     */
    private $dateenvoifaq;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReponseFaq", type="date", nullable=false)
     */
    private $datereponsefaq;


}

