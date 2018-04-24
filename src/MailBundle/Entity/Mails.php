<?php
/**
 * Created by PhpStorm.
 * User: Ivan Landry ONANA
 * Date: 10/04/2018
 * Time: 07:27
 */

namespace MailBundle\Entity;


class Mails
{
    private $nom;
    private $email;
    private $text;

    /**
     * Mails constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

}