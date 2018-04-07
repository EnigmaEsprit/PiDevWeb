<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commandes
 *
 * @ORM\Table(name="commandes", indexes={@ORM\Index(name="commandes_ibfk_1", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\PanierBundle\Repository\panierRepository")
 */
class Commandes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommande;

    /**
     * @var float
     *
     * @ORM\Column(name="prixTotal", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixtotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDeCommande", type="date", nullable=false)
     */
    private $datedecommande;

    /**
     * @var string
     *
     * @ORM\Column(name="idTransaction", type="string", nullable=false)
     */
    private $idtransaction;

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
     * @var integer
     *
     * @ORM\Column(name="commande", type="array", nullable=true)
     */
    private $commande;
    /**
     * @var integer
     *
     * @ORM\Column(name="reference", type="integer", nullable=true)
     */
    private $reference;

    /**
     * Commandes constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }

    /**
     * @param int $idcommande
     */
    public function setIdcommande($idcommande)
    {
        $this->idcommande = $idcommande;
    }

    /**
     * @return float
     */
    public function getPrixtotal()
    {
        return $this->prixtotal;
    }

    /**
     * @param float $prixtotal
     */
    public function setPrixtotal($prixtotal)
    {
        $this->prixtotal = $prixtotal;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return \DateTime
     */
    public function getDatedecommande()
    {
        return $this->datedecommande;
    }

    /**
     * @param \DateTime $datedecommande
     */
    public function setDatedecommande($datedecommande)
    {
        $this->datedecommande = $datedecommande;
    }

    /**
     * @return string
     */
    public function getIdtransaction()
    {
        return $this->idtransaction;
    }

    /**
     * @param string $idtransaction
     */
    public function setIdtransaction($idtransaction)
    {
        $this->idtransaction = $idtransaction;
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
     * @return array
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * @param array $commande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;
    }

    /**
     * @return int
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param int $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }





}

