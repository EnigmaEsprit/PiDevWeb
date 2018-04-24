<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="reclamations_ibfk_2", columns={"idMagasin"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\ReclamationBundle\Repository\ReclamationsRepository")
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
     * @ORM\Column(name="dateEnvoiReclamation", type="datetime", nullable=true)
     */
    private $dateenvoireclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReponseReclamation", type="datetime", nullable=true)
     */
    private $datereponsereclamation;

    /**
     * @var integer
     *
     * @ORM\Column(name="statusReclamation", type="smallint", nullable=false)
     */
    private $statusreclamation = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="suiviReclamation", type="string", length=100, nullable=false)
     */
    private $suivireclamation = 'En attente';

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

    /**
     * Reclamations constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdreclamation()
    {
        return $this->idreclamation;
    }

    /**
     * @param int $idreclamation
     */
    public function setIdreclamation($idreclamation)
    {
        $this->idreclamation = $idreclamation;
    }

    /**
     * @return string
     */
    public function getTypereclamation()
    {
        return $this->typereclamation;
    }

    /**
     * @param string $typereclamation
     */
    public function setTypereclamation($typereclamation)
    {
        $this->typereclamation = $typereclamation;
    }

    /**
     * @return string
     */
    public function getObjetreclamation()
    {
        return $this->objetreclamation;
    }

    /**
     * @param string $objetreclamation
     */
    public function setObjetreclamation($objetreclamation)
    {
        $this->objetreclamation = $objetreclamation;
    }

    /**
     * @return string
     */
    public function getContenureclamation()
    {
        return $this->contenureclamation;
    }

    /**
     * @param string $contenureclamation
     */
    public function setContenureclamation($contenureclamation)
    {
        $this->contenureclamation = $contenureclamation;
    }

    /**
     * @return \DateTime
     */
    public function getDateenvoireclamation()
    {
        return $this->dateenvoireclamation;
    }

    /**
     * @param \DateTime $dateenvoireclamation
     */
    public function setDateenvoireclamation($dateenvoireclamation)
    {
        $this->dateenvoireclamation = $dateenvoireclamation;
    }

    /**
     * @return \DateTime
     */
    public function getDatereponsereclamation()
    {
        return $this->datereponsereclamation;
    }

    /**
     * @param \DateTime $datereponsereclamation
     */
    public function setDatereponsereclamation($datereponsereclamation)
    {
        $this->datereponsereclamation = $datereponsereclamation;
    }

    /**
     * @return int
     */
    public function getStatusreclamation()
    {
        return $this->statusreclamation;
    }

    /**
     * @param int $statusreclamation
     */
    public function setStatusreclamation($statusreclamation)
    {
        $this->statusreclamation = $statusreclamation;
    }

    /**
     * @return string
     */
    public function getSuivireclamation()
    {
        return $this->suivireclamation;
    }

    /**
     * @param string $suivireclamation
     */
    public function setSuivireclamation($suivireclamation)
    {
        $this->suivireclamation = $suivireclamation;
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

    /**
     * @return \Users
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param \Users $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

}

