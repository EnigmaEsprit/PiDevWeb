<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magasins
 *
 * @ORM\Table(name="magasins", indexes={@ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\MagasinsBundle\Repository\MagasinsRepository")
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

    /**
     * Magasins constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdmagasin()
    {
        return $this->idmagasin;
    }

    /**
     * @param int $idmagasin
     */
    public function setIdmagasin($idmagasin)
    {
        $this->idmagasin = $idmagasin;
    }

    /**
     * @return string
     */
    public function getNommagasin()
    {
        return $this->nommagasin;
    }

    /**
     * @param string $nommagasin
     */
    public function setNommagasin($nommagasin)
    {
        $this->nommagasin = $nommagasin;
    }

    /**
     * @return string
     */
    public function getPhotomagasin()
    {
        return $this->photomagasin;
    }

    /**
     * @param string $photomagasin
     */
    public function setPhotomagasin($photomagasin)
    {
        $this->photomagasin = $photomagasin;
    }

    /**
     * @return string
     */
    public function getDescriptionmagasin()
    {
        return $this->descriptionmagasin;
    }

    /**
     * @param string $descriptionmagasin
     */
    public function setDescriptionmagasin($descriptionmagasin)
    {
        $this->descriptionmagasin = $descriptionmagasin;
    }

    /**
     * @return \DateTime
     */
    public function getDatecreationmagasin()
    {
        return $this->datecreationmagasin;
    }

    /**
     * @param \DateTime $datecreationmagasin
     */
    public function setDatecreationmagasin($datecreationmagasin)
    {
        $this->datecreationmagasin = $datecreationmagasin;
    }

    /**
     * @return string
     */
    public function getContactmagasin()
    {
        return $this->contactmagasin;
    }

    /**
     * @param string $contactmagasin
     */
    public function setContactmagasin($contactmagasin)
    {
        $this->contactmagasin = $contactmagasin;
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

