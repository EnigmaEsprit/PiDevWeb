<?php

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Produits
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="produits", indexes={@ORM\Index(name="idMagasin", columns={"idMagasin"})})
 * @ORM\Entity(repositoryClass="SoukElMedina\ProduitBundle\Repository\ProduitRepository")
 */
class Produits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="referenceProduit", type="integer", nullable=false)
     */
    private $referenceproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProduit", type="string", length=50, nullable=false)
     */
    private $nomproduit;

    /**
     * @var float
     *
     * @ORM\Column(name="prixProduit", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="photoProduit", type="string", length=50, nullable=false)
     */
    private $photoproduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantiteProduit", type="integer", nullable=false)
     */
    private $quantiteproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=50, nullable=false)
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpromotion", type="integer", nullable=true)
     */
    private $idpromotion;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieMagasin", type="string", length=50, nullable=false)
     */
    private $categoriemagasin;
    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float", nullable=true)
     */
    private $note;
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
            $this->photoproduit = $filename . '.' . $this->file->guessExtension();

        }
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image imagelink
        if (isset($this->photoproduit)) {
            // store the old name to delete after the update
            $this->temp= $this->photoproduit;
            $this->photoproduit = null;
        } else {
            $this->photoproduit = 'initial';
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
        $this->file->move($this->getUploadRootDir(), $this->photoproduit);

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
        return null === $this->photoproduit ? null : $this->getUploadRootDir().'/'.$this->photoproduit;
    }

    public function getWebimagelink()
    {
        return null === $this->photoproduit ? null : $this->getUploadDir().'/'.'/'.$this->photoproduit;
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
    public function getReferenceproduit()
    {
        return $this->referenceproduit;
    }

    /**
     * @param int $referenceproduit
     */
    public function setReferenceproduit($referenceproduit)
    {
        $this->referenceproduit = $referenceproduit;
    }

    /**
     * @return string
     */
    public function getNomproduit()
    {
        return $this->nomproduit;
    }

    /**
     * @param string $nomproduit
     */
    public function setNomproduit($nomproduit)
    {
        $this->nomproduit = $nomproduit;
    }

    /**
     * @return float
     */
    public function getPrixproduit()
    {
        return $this->prixproduit;
    }

    /**
     * @param float $prixproduit
     */
    public function setPrixproduit($prixproduit)
    {
        $this->prixproduit = $prixproduit;
    }

    /**
     * @return string
     */
    public function getPhotoproduit()
    {
        return $this->photoproduit;
    }

    /**
     * @param string $photoproduit
     */
    public function setPhotoproduit($photoproduit)
    {
        $this->photoproduit = $photoproduit;
    }

    /**
     * @return int
     */
    public function getQuantiteproduit()
    {
        return $this->quantiteproduit;
    }

    /**
     * @param int $quantiteproduit
     */
    public function setQuantiteproduit($quantiteproduit)
    {
        $this->quantiteproduit = $quantiteproduit;
    }

    /**
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $active
     */
    public function setActive($active)
    {
        $this->active = $active;
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
    public function getCategoriemagasin()
    {
        return $this->categoriemagasin;
    }

    /**
     * @param string $categoriemagasin
     */
    public function setCategoriemagasin($categoriemagasin)
    {
        $this->categoriemagasin = $categoriemagasin;
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
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param float $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }



}



