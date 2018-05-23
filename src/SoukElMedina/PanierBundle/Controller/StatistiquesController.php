<?php

namespace SoukElMedina\PanierBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StatistiquesController extends Controller
{
    public function indexAction(Request $request){

        $pieChart = new PieChart();
        $piechartdate=new PieChart();
        $em = $this->getDoctrine()->getManager();
        $lignecommande = $em->getRepository('SoukElMedinaPidevBundle:Lignecommandes')->stats();
        $totalQuantiteProduit = $em->getRepository('SoukElMedinaPidevBundle:Lignecommandes')->findAll();
        $totalQuantite=0;

        //var_dump($lignecommande);

        foreach ($totalQuantiteProduit as $produit){

            $totalQuantite=$totalQuantite+ $produit->getQuantite();
        }

        $data = array();
        $stats = ['nomproduit','quantite'];
        array_push($data,$stats);

        foreach ($lignecommande as $ligne)
        {

            $stats=array();
            array_push($stats,$ligne['nomproduit'],$ligne[1]);
            $nb=(($ligne['1']*100)/$totalQuantite);
            $stats=[$ligne['nomproduit'],$nb];
            array_push($data,$stats);
        }
       // var_dump($totalQuantite);

        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setPieSliceText('label');
        $pieChart->getOptions()->setTitle('Statistiques Produits vendus');
        $pieChart->getOptions()->setPieStartAngle(100);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getLegend()->setPosition('none');
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);




        $datetime = date("d/m/Y");
      // echo $datetime;



            $datev = array();
            $statsdatevente = ['nomproduit', 'quantite'];
            array_push($datev, $statsdatevente);

           if($request->get('datevente')) {
               $datevente = $request->get('datevente');
               $lignecommandedatevente = $em->getRepository('SoukElMedinaPidevBundle:Lignecommandes')->GetStatistiqueDateVenteProduit($datevente);

           }else{
               $lignecommandedatevente = $em->getRepository('SoukElMedinaPidevBundle:Lignecommandes')->GetStatistiqueDateVenteProduit($datetime);

           }
        foreach ($lignecommandedatevente as $ligne)
            {

                $stats=array();
                array_push($stats,$ligne['nomproduit'],$ligne[1]);
                $nb=(($ligne['1']*100)/$totalQuantite);
                $stats=[$ligne['nomproduit'],$nb];
                array_push($datev,$stats);
            }
            $piechartdate->getData()->setArrayToDataTable($datev);
            $piechartdate->getOptions()->setTitle('Pourcentages de vente par date');
            $piechartdate->getOptions()->setHeight(500);
            $piechartdate->getOptions()->setWidth(900);
            $piechartdate->getOptions()->getTitleTextStyle()->setBold(true);
            $piechartdate->getOptions()->getTitleTextStyle()->setColor('#009900');
            $piechartdate->getOptions()->getTitleTextStyle()->setItalic(true);
            $piechartdate->getOptions()->getTitleTextStyle()->setFontName('Arial');
            $piechartdate->getOptions()->getTitleTextStyle()->setFontSize(20);




//var_dump($lignecommandedatevente);



        return $this->render('@SoukElMedinaPanier/Vendeur/statistiques.html.twig', array(
            'piechart' => $pieChart,
            'piechartdate'=>$piechartdate));}
}
