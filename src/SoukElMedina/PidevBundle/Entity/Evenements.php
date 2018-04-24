<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenements
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="evenements", indexes={@ORM\Index(name="IDX_E10AD4005E5C27E9", columns={"iduser"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\EvenementBundle\Repository\EvenementRepository")
 * @ORM\MappedSuperclass
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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="image_link", type="string", length=255, nullable=false)
     */
    private $imageLink;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvenement", type="string", length=50, nullable=false)
     */
    private $nomevenement;

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
     * @var string
     *
     * @ORM\Column(name="descriptionEvenement", type="string", length=255, nullable=false)
     */
    private $descriptionevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreDesPlacesRestante", type="integer", nullable=true)
     */
    private $nombredesplacesrestante;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=255, nullable=true)
     */
    private $dateFin;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     * })
     */
    private $iduser;

    /**
     * Evenements constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $idevenement
     */
    public function setId($idevenement)
    {
        $this->id = $idevenement;
    }

    /**
     * @return string
     */
    public function getImageLink()
    {
        return $this->imageLink;
    }

    /**
     * @param string $imageLink
     */
    public function setImageLink($imageLink)
    {
        $this->imageLink = $imageLink;
    }

    /**
     * @return string
     */
    public function getNomevenement()
    {
        return $this->nomevenement;
    }

    /**
     * @param string $nomevenement
     */
    public function setNomevenement($nomevenement)
    {
        $this->nomevenement = $nomevenement;
    }

    /**
     * @return int
     */
    public function getNombredeplaces()
    {
        return $this->nombredeplaces;
    }

    /**
     * @param int $nombredeplaces
     */
    public function setNombredeplaces($nombredeplaces)
    {
        $this->nombredeplaces = $nombredeplaces;
    }

    /**
     * @return float
     */
    public function getTarifevenement()
    {
        return $this->tarifevenement;
    }

    /**
     * @param float $tarifevenement
     */
    public function setTarifevenement($tarifevenement)
    {
        $this->tarifevenement = $tarifevenement;
    }

    /**
     * @return string
     */
    public function getDescriptionevenement()
    {
        return $this->descriptionevenement;
    }

    /**
     * @param string $descriptionevenement
     */
    public function setDescriptionevenement($descriptionevenement)
    {
        $this->descriptionevenement = $descriptionevenement;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getNombredesplacesrestante()
    {
        return $this->nombredesplacesrestante;
    }

    /**
     * @param int $nombredesplacesrestante
     */
    public function setNombredesplacesrestante($nombredesplacesrestante)
    {
        $this->nombredesplacesrestante = $nombredesplacesrestante;
    }

    /**
     * @return string
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param string $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
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

