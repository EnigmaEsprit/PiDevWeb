<?php

namespace MailBundle\Controller;

use MailBundle\Entity\Mails;
use MailBundle\Form\MailsType;
use SoukElMedina\PidevBundle\Entity\Reclamations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swift_Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MailController extends Controller
{
    public function repondreReclamationAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository('SoukElMedinaPidevBundle:Reclamations') -> find($id);
        $mail = new Mails();
        $form= $this->createForm(MailsType::class, $mail);
        $form->handleRequest($request) ;
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation -> setSuivireclamation('Traité');
            $message = Swift_Message::newInstance()
                ->setSubject('Réponse réclamation')
                ->setFrom('boumaiazaoussama@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody($mail->getText(), 'text/html');
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));
        }
        return $this->render('MailBundle:Default:envoi_reponse_reclamation.html.twig',
            array('form'=>$form->createView(),'reclamation'=>$reclamation));
    }

    public function successAction(){
        return new Response("Email envoyé avec succès. Merci de vérifier votre boite email.");
    }
}
