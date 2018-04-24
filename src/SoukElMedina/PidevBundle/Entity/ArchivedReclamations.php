<?php
/**
 * Created by PhpStorm.
 * User: Ivan Landry ONANA
 * Date: 11/04/2018
 * Time: 03:59
 */

namespace SoukElMedina\PidevBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="archived_reclamations")
 * @ORM\Entity
 */
class ArchivedReclamations
{
    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     */
    protected $originalId;

    /**
     * @var array $data
     *
     * @ORM\Column(type="json_array", nullable=true)
     */
    protected $data;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param int $originalId
     */
    public function setOriginalId($originalId)
    {
        $this->originalId = $originalId;
    }

    /**
     * @return int
     */
    public function getOriginalId()
    {
        return $this->originalId;
    }}