<?php

namespace SoukElMedina\PidevBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1483A5E992FC23A8", columns={"username_canonical"}), @ORM\UniqueConstraint(name="UNIQ_1483A5E9A0D96FBF", columns={"email_canonical"}), @ORM\UniqueConstraint(name="UNIQ_1483A5E9C05FB297", columns={"confirmation_token"})})
 * @ORM\Entity
 */
class Users extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeNaissance", type="datetime", nullable=true)
     */
    private $datedenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=5, nullable=true)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=20, nullable=true)
     */
    private $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="integer", nullable=true)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDuTelephone", type="string", length=13, nullable=true)
     */
    private $numerodutelephone;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="imageUser", type="string", length=1000, nullable=true)
     */
    private $imageuser;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDeCarteBancaire", type="string", length=16, nullable=true)
     */
    private $numerodecartebancaire;

    /**
     * @var string
     *
     * @ORM\Column(name="dateDeValidation", type="string", length=10, nullable=true)
     */
    private $datedevalidation;

    /**
     * @var string
     *
     * @ORM\Column(name="codeSecret", type="string", length=300, nullable=true)
     */
    private $codesecret;

    /**
     * @var string
     *
     * @ORM\Column(name="situaitionFiscal", type="string", length=20, nullable=true)
     */
    private $situaitionfiscal;

    /**
     * @var string
     *
     * @ORM\Column(name="ribBancaire", type="string", length=40, nullable=true)
     */
    private $ribbancaire;
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return \DateTime
     */
    public function getDatedenaissance()
    {
        return $this->datedenaissance;
    }

    /**
     * @param \DateTime $datedenaissance
     */
    public function setDatedenaissance($datedenaissance)
    {
        $this->datedenaissance = $datedenaissance;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return int
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param int $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getNumerodutelephone()
    {
        return $this->numerodutelephone;
    }

    /**
     * @param string $numerodutelephone
     */
    public function setNumerodutelephone($numerodutelephone)
    {
        $this->numerodutelephone = $numerodutelephone;
    }


    /**
     * @return string
     */
    public function getImageuser()
    {
        return $this->imageuser;
    }

    /**
     * @param string $imageuser
     */
    public function setImageuser($imageuser)
    {
        $this->imageuser = $imageuser;
    }

    /**
     * @return string
     */
    public function getNumerodecartebancaire()
    {
        return $this->numerodecartebancaire;
    }

    /**
     * @param string $numerodecartebancaire
     */
    public function setNumerodecartebancaire($numerodecartebancaire)
    {
        $this->numerodecartebancaire = $numerodecartebancaire;
    }

    /**
     * @return string
     */
    public function getDatedevalidation()
    {
        return $this->datedevalidation;
    }

    /**
     * @param string $datedevalidation
     */
    public function setDatedevalidation($datedevalidation)
    {
        $this->datedevalidation = $datedevalidation;
    }

    /**
     * @return string
     */
    public function getCodesecret()
    {
        return $this->codesecret;
    }

    /**
     * @param string $codesecret
     */
    public function setCodesecret($codesecret)
    {
        $this->codesecret = $codesecret;
    }

    /**
     * @return string
     */
    public function getSituaitionfiscal()
    {
        return $this->situaitionfiscal;
    }

    /**
     * @param string $situaitionfiscal
     */
    public function setSituaitionfiscal($situaitionfiscal)
    {
        $this->situaitionfiscal = $situaitionfiscal;
    }

    /**
     * @return string
     */
    public function getRibbancaire()
    {
        return $this->ribbancaire;
    }

    /**
     * @param string $ribbancaire
     */
    public function setRibbancaire($ribbancaire)
    {
        $this->ribbancaire = $ribbancaire;
    }




}

