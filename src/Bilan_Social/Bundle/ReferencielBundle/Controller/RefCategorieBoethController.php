<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Controller;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefCategorieBoethType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Refcategorieboeth controller.
 *
 */
class RefCategorieBoethController extends Controller
{
    /**
     * Lists all refCategorieBoeth entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refCategorieBoeths = $em->getRepository('ReferencielBundle:RefCategorieBoeth')->findAll();

        return $this->render('@Referenciel/refcategorieboeth/index.html.twig', array(
            'refCategorieBoeths' => $refCategorieBoeths,
        ));
    }

    /**
     * Creates a new refCategorieBoeth entity.
     *
     */
    public function newAction(Request $request)
    {
        $refCategorieBoeth = new Refcategorieboeth();
        $form = $this->createForm(RefCategorieBoethType::class, $refCategorieBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refCategorieBoeth);
            $em->flush();

            return $this->redirectToRoute('refcategorieboeth_show', array('idCategorieboeth' => $refCategorieBoeth->getIdcategorieboeth()));
        }

        return $this->render('@Referenciel/refcategorieboeth/new.html.twig', array(
            'refCategorieBoeth' => $refCategorieBoeth,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refCategorieBoeth entity.
     *
     */
    public function showAction(RefCategorieBoeth $refCategorieBoeth)
    {
        $deleteForm = $this->createDeleteForm($refCategorieBoeth);

        return $this->render('@Referenciel/refcategorieboeth/show.html.twig', array(
            'refCategorieBoeth' => $refCategorieBoeth,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refCategorieBoeth entity.
     *
     */
    public function editAction(Request $request, RefCategorieBoeth $refCategorieBoeth)
    {
        $deleteForm = $this->createDeleteForm($refCategorieBoeth);
        $editForm = $this->createForm(RefCategorieBoethType::class, $refCategorieBoeth);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refcategorieboeth_edit', array('idCategorieboeth' => $refCategorieBoeth->getIdcategorieboeth()));
        }

        return $this->render('@Referenciel/refcategorieboeth/edit.html.twig', array(
            'refCategorieBoeth' => $refCategorieBoeth,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refCategorieBoeth entity.
     *
     */
    public function deleteAction(Request $request, RefCategorieBoeth $refCategorieBoeth)
    {
        $form = $this->createDeleteForm($refCategorieBoeth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $refCategorieBoeth->setBlVali(1);
            $em->flush($refCategorieBoeth);
            $this->addFlash(
                    'action', $this->get('translator')->trans('archive.referentiel.flash')
            );
        }

        return $this->redirectToRoute('refcategorieboeth_index');
    }

    /**
     * Creates a form to delete a refCategorieBoeth entity.
     *
     * @param RefCategorieBoeth $refCategorieBoeth The refCategorieBoeth entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefCategorieBoeth $refCategorieBoeth)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refcategorieboeth_delete', array('idCategorieboeth' => $refCategorieBoeth->getIdcategorieboeth())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function generateCsvAction() {


        $service = $this->container->get('referenciel.ReferencielExporter');

        $information = array(
            'filename'    => "refCategorieBoeth",
            'requete_sql' => "SELECT `CD_CATEGORIE_BOETH` as 'Code' ,`LB_CATEGORIE_BOETH` as 'Libellé', (CASE WHEN BL_VALI <> 0 THEN 'Oui' ELSE 'Non' END) as 'Archivé' FROM `ref_categorie_boeth`",
            'champ'       => array('Code', 'Libellé', 'Archivé'),
        );

        $fichierCSV = $service->exportReferenciel($information);

        return $fichierCSV;
    }
}
