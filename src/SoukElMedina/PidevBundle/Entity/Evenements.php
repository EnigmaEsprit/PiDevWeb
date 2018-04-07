<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenements
 *@ORM\HasLifecycleCallbacks
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
     * @var integer
     *
     * @ORM\Column(name="nombreDesPlacesRestante", type="integer", nullable=true)
     */
    private $nombredesplacesrestante;

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
//    /**
//     * @var float     Latitude of the position
//     *
//     * @ORM\Column(name="lat", type="float", nullable=true)
//     */
//    protected $lat;
//
//    /**
//     * @var float     Longitude of the position
//     *
//     * @ORM\Column(name="lng", type="float", nullable=true)
//     */
//    protected $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", nullable=true)
     */
    private $date;
    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", nullable=true)
     */
    private $datefin;

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
     * @var integer
     *
     * @ORM\Column(name="verifier", type="integer", nullable=true)
     */
    private $verifier;
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
     * @ORM\Column(name="image_link",type="string", length=255, nullable=false)
     */
    public $imagelink;

    /**
     * @Assert\File(maxSize="1000000000")
     */
    public $file;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->file) {

            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            var_dump($filename.'--------');
            $this->imagelink = $filename . '.' . $this->file->guessExtension();

        }
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image imagelink
        if (isset($this->imagelink)) {
            // store the old name to delete after the update
            $this->temp= $this->imagelink;
            $this->imagelink = null;
        } else {
            $this->imagelink = 'initial';
        }
    }


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file)
        {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->imagelink);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if(file_exists($this->getAbsoluteimagelink())) {
            if ($this->getUploadRootDir() . $this->logo = $this->getAbsoluteimagelink()) {
                unlink($this->logo);
            }
        }


    }

    public function getAbsoluteimagelink()
    {
        return null === $this->imagelink ? null : $this->getUploadRootDir().'/'.$this->imagelink;
    }

    public function getWebimagelink()
    {
        return null === $this->imagelink ? null : $this->getUploadDir().'/'.'/'.$this->imagelink;
    }

    public function getUploadRootDir()
    {
        // the absolute directory imagelink where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir().'/';
    }

    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/Images';

    }

    /**
     * Set imagelink
     *
     * @param string $imagelink
     */
    public function setimagelink($imagelink)
    {
        $this->imagelink = $imagelink;
    }

    /**
     * Get imagelink
     *
     * @return string
     */
    public function getimagelink()
    {
        return $this->imagelink;
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
    public function setNomevenement( $nomevenement)
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
    public function setTarifevenement( $tarifevenement)
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
    public function setDescriptionevenement( $descriptionevenement)
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
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param string $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return int
     */
    public function getVerifier()
    {
        return $this->verifier;
    }

    /**
     * @param int $verifier
     */
    public function setVerifier($verifier)
    {
        $this->verifier = $verifier;
    }

//    public function getLat()
//    {
//        return $this->lat;
//    }
//
//    public function setLat($lat)
//    {
//        if (is_string($lat)) {
//            $lat = floatval($lat);
//        }
//        $this->lat = $lat;
//    }
//
//    public function getLng()
//    {
//        return $this->lng;
//    }
//
//    public function setLng($lng)
//    {
//        if (is_string($lng)) {
//            $lng = floatval($lng);
//        }
//        $this->lng = $lng;
//    }







}

