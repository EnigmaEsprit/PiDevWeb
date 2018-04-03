<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01/04/2018
 * Time: 03:14
 */

namespace SoukElMedina\DecouverteBundle\Controller;


use ScayTrase\SmsDeliveryBundle\Service\ShortMessageInterface;

class MyMessage implements ShortMessageInterface
{

    /**
     * Get Message Body
     * @return string message to be sent
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    /**
     * Get Message Recipient
     * @return string message recipient number
     */
    public function getRecipient()
    {
        // TODO: Implement getRecipient() method.
    }

    /**
     * Set Message Recipient
     * @param $recipient string
     * @return void
     */
    public function setRecipient($recipient)
    {
        // TODO: Implement setRecipient() method.
    }
}