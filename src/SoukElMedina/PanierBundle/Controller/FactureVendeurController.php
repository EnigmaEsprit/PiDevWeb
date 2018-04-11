<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 3/29/2018
 * Time: 5:02 AM
 */

namespace SoukElMedina\PanierBundle\Controller;

use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SoukElMedina\PanierBundle\Repository\panierRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FactureVendeurController extends Controller
{


    public function facturesPDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('SoukElMedinaPidevBundle:Commandes')->find($id);

        if (!$facture) {
             return $this->redirectToRoute('souk_el_medina_panier_commande_vendeur');
        }

        $html = $this->renderView('SoukElMedinaPanierBundle:Vendeur:CommandesPDF.html.twig',array(
            'facture'=>$facture));

        try{
            $pdf = new Html2Pdf('P','A4','fr');
            $pdf->pdf->SetAuthor('SoukElMedina');
            $pdf->pdf->SetTitle('Facture '.$facture->getReference());
            $pdf->pdf->SetSubject('Facture SoukElMedina');
            $pdf->pdf->SetKeywords('facture,soukelmedina');
            $pdf->pdf->SetDisplayMode('real');
            $pdf->writeHTML($html);
            $pdf->Output('Facture.pdf');


//require 'phpmailer.php';

        }catch(\HTML2PDF_exception $e){
            die($e);
        }

        $response = new Response();
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;
    }
}