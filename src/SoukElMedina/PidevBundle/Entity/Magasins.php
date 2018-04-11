<?php

namespace SoukElMedina\PidevBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Magasins
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="magasins", indexes={@ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
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
     * @ORM\Column(name="photoMagasin", type="string",  nullable=true)
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
     * @ORM\OneToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;
    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255)
     */
    private $note;
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
            $this->photomagasin = $filename . '.' . $this->file->guessExtension();

        }
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image imagelink
        if (isset($this->photomagasin)) {
            // store the old name to delete after the update
            $this->temp= $this->photomagasin;
            $this->photomagasin = null;
        } else {
            $this->photomagasin = 'initial';
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
        $this->file->move($this->getUploadRootDir(), $this->photomagasin);

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
        return null === $this->photomagasin ? null : $this->getUploadRootDir().'/'.$this->photomagasin;
    }

    public function getWebimagelink()
    {
        return null === $this->photomagasin ? null : $this->getUploadDir().'/'.'/'.$this->photomagasin;
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
        return $this;

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
    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

}
