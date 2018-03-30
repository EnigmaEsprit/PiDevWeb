<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Promotions
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="promotions", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="IdProduit", columns={"IdProduit"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\PromotionBundle\Repository\PromotionRepository")
 * @ORM\MappedSuperclass
 */
class Promotions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPromotion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpromotion;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPromotion", type="string", length=50, nullable=false)
     */
    private $nompromotion;


    /**
     * @var string
     *
     * @ORM\Column(name="dateDebut", type="string", nullable=false)
     */
    private $datedebut;

    /**
     * @var string
     *
     * @ORM\Column(name="dateFin", type="string", nullable=false)
     */
    private $datefin;
    /**
     * @var string
     *
     * @ORM\Column(name="pourcentage", type="string", nullable=false)
     */
    private $pourcentage;
    /**
     * @var float
     *
     * @ORM\Column(name="new_prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $newPrix;

    /**
     * @var \Produits
     *
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdProduit", referencedColumnName="idProduit")
     * })
     */
    private $idproduit;

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
     * @return int
     */
    public function getIdpromotion()
    {
        return $this->idpromotion;
    }

    /**
     * @param int $idpromotion
     */
    public function setIdpromotion($idpromotion)
    {
        $this->idpromotion = $idpromotion;
    }

    /**
     * @return string
     */
    public function getNompromotion()
    {
        return $this->nompromotion;
    }

    /**
     * @param string $nompromotion
     */
    public function setNompromotion($nompromotion)
    {
        $this->nompromotion = $nompromotion;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return \Produits
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    /**
     * @param \Produits $idproduit
     */
    public function setIdproduit($idproduit)
    {
        $this->idproduit = $idproduit;
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
     * @return string
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * @param string $pourcentage
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    }

    /**
     * @return float
     */
    public function getNewPrix()
    {
        return $this->newPrix;
    }

    /**
     * @param float $newPrix
     */
    public function setNewPrix($newPrix)
    {
        $this->newPrix = $newPrix;
    }


    /**
     * Generates the magic method
     *
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->nompromotion;
        // to show the id of the Category in the select
        // return $this->id;
    }


}

