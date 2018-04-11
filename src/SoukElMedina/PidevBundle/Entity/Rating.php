<?php
/**
 * Created by PhpStorm.
 * User: besmelah
 * Date: 10/04/2018
 * Time: 14:02
 */

namespace SoukElMedina\PidevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity(repositoryClass="SoukElMedina\MagasinsBundle\Repository\MagasinRepository")
 */

class Rating
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer" ,nullable=true)
     */
    private $rating;
    /**
     * @ORM\ManyToOne(targetEntity="Produits")
     * @ORM\JoinColumn(name="idProduit",referencedColumnName="idProduit",onDelete="CASCADE")
     */
    private $idProduit;

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param mixed $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }



}