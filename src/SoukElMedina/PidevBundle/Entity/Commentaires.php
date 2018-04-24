<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="commentaires_ibfk_2", columns={"idProduit"}), @ORM\Index(name="idevenement", columns={"idEvenement"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\CommentairesBundle\Repository\CommentairesRepository")
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
     * @ORM\Column(name="dateModificationCommentaire", type="date", nullable=true)
     */
    private $datemodificationcommentaire;

    /**
     * @var \integer
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProduit", referencedColumnName="idProduit")
     * })
     */
    private $idproduit;

    /**
     * @var \integer
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;

    /**
     * @var \integer
     *
     * @ORM\ManyToOne(targetEntity="Evenements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvenement", referencedColumnName="idEvenement")
     * })
     */
    private $idevenement;

    /**
     * Commentaires constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdcommentaire()
    {
        return $this->idcommentaire;
    }

    /**
     * @param int $idcommentaire
     */
    public function setIdcommentaire($idcommentaire)
    {
        $this->idcommentaire = $idcommentaire;
    }

    /**
     * @return string
     */
    public function getContenucommentaire()
    {
        return $this->contenucommentaire;
    }

    /**
     * @param string $contenucommentaire
     */
    public function setContenucommentaire($contenucommentaire)
    {
        $this->contenucommentaire = $contenucommentaire;
    }

    /**
     * @return \DateTime
     */
    public function getDateajoutcommentaire()
    {
        return $this->dateajoutcommentaire;
    }

    /**
     * @param \DateTime $dateajoutcommentaire
     */
    public function setDateajoutcommentaire($dateajoutcommentaire)
    {
        $this->dateajoutcommentaire = $dateajoutcommentaire;
    }

    /**
     * @return \DateTime
     */
    public function getDatemodificationcommentaire()
    {
        return $this->datemodificationcommentaire;
    }

    /**
     * @param \DateTime $datemodificationcommentaire
     */
    public function setDatemodificationcommentaire($datemodificationcommentaire)
    {
        $this->datemodificationcommentaire = $datemodificationcommentaire;
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

    /**
     * @return int
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    /**
     * @param int $idproduit
     */
    public function setIdproduit($idproduit)
    {
        $this->idproduit = $idproduit;
    }

    /**
     * @return int
     */
    public function getIdevenement()
    {
        return $this->idevenement;
    }

    /**
     * @param int $idevenement
     */
    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;
    }


}

