<?php

namespace SoukElMedina\PidevBundle\Controller;

use SoukElMedina\PidevBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Produit controller.
 *
 */
class ProduitsController extends Controller
{
    /**
     * Lists all produit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findAll();
        $produit = new Produits();
        $form = $this->createForm('SoukElMedina\PidevBundle\Form\ProduitsSearch', $produit);

        return $this->render('SoukElMedinaPidevBundle:produits:index.html.twig', array(
            'produits' => $produits,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $produit = new Produits();

        $form = $this->createForm('SoukElMedina\PidevBundle\Form\ProduitsType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $magasin=$em->getRepository('SoukElMedinaPidevBundle:Magasins')->findOneBy(array('iduser' => $this->getUser()));
            $produit->setIdmagasin($magasin);
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('SoukElMedinaPidevBundle:produits:new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     */
    public function showAction(Produits $produit ,Request $request)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $zffecte=new Produits();
        $note=$this->createForm('SoukElMedina\ProduitBundle\Form\rating2', $zffecte);

        if($note->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $notee=$note->handleRequest($request);
            echo $notee;
            die();
        }
        return $this->render('produits/show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
            'rech'=>$note->createView()
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     */
    public function editAction(Request $request, Produits $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('SoukElMedina\PidevBundle\Form\ProduitsType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('SoukElMedinaPidevBundle:produits:edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     */
    public function deleteAction($idproduit)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");
        $EM = $this->getDoctrine()->getManager();
        $produit = $EM->getRepository("SoukElMedinaPidevBundle:Produits")->find($idproduit);
        $EM->remove($produit);
        $EM->flush();
        return $this->redirectToRoute('produits_index');
    }
    public function RechercheParPrixAction($prix)

    {
        $em = $this->getDoctrine()->getManager();
        $v=null;
        $produits = $em->getRepository('SoukElMedinaPidevBundle:Produits')->findProduitByPrice($prix);
        foreach ($produits as $produit){
            $v[$produit->getIdproduit()] = array($produit->getReferenceproduit(),
                $produit->getNomproduit(),$produit->getPrixproduit(),$produit->getPhotoproduit(),
                $produit->getQuantiteproduit(),$produit->getActive(),$produit->getIdpromotion(),$produit->getCategoriemagasin()
            ,$produit->getIdmagasin()->getNommagasin());
        }
        $response = new JsonResponse();
        return $response->setData($v);
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produits $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produits $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produits_delete', array('idproduit' => $produit->getIdproduit())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
