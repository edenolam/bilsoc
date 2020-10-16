<?php

namespace Bilan_Social\Bundle\ApaBundle\Controller;

use Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelNonPermanent;
use Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelPermanent;
use Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationFonctionnaire;
use Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale;
use Bilan_Social\Bundle\ApaBundle\Form\InformationGeneraleType;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Informationgenerale controller.
 *
 */
class InformationGeneraleController extends AbstractBSController {

    /**
     * Creates a new informationGenerale entity.
     *
     */
    public function newAction(Request $request) {
        
        $OpenModal = false;
        
        $em = $this->getDoctrine()->getManager();
        $informationGenerale = new Informationgenerale();
        // $form = $this->createForm('Bilan_Social\Bundle\ApaBundle\Form\InformationGeneraleType', $informationGenerale);

        $AgentRemunerationFonctionnaire = $em->getRepository('ApaBundle:AgentRemunerationFonctionnaire')->findByIdInfoGene($informationGenerale);
        $AgentRemunerationContractuelNonPermanent = $em->getRepository('ApaBundle:AgentRemunerationContractuelNonPermanent')->findByIdInfoGene($informationGenerale);
        $AgentRemunerationContractuelPermanent = $em->getRepository('ApaBundle:AgentRemunerationContractuelPermanent')->findByIdInfoGene($informationGenerale);
        $RefCategorie = $em->getRepository('ReferencielBundle:RefCategorie')->findBy(array('blVali' => false));
        $RefEmploiNonPermanent = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findBy(array('blVali' => false));

        if (count($AgentRemunerationFonctionnaire) === 0) {
            foreach ($RefCategorie as $index => $categorie) {
                $var_name = 'AgentRemunerationFonctionnaire' . $index;
                $$var_name = new AgentRemunerationFonctionnaire();
                $$var_name->setIdInfoGene($informationGenerale);
                $$var_name->setRefCategorie($categorie);
                $informationGenerale->getAgentRemuFonctionnaire()->add($$var_name);
            }
        }
        if (count($AgentRemunerationContractuelNonPermanent) === 0) {
            foreach ($RefEmploiNonPermanent as $index => $EmploiNonPermanent) {
                $var_name = 'AgentRemunerationContractuelNonPermanent' . $index;
                $$var_name = new AgentRemunerationContractuelNonPermanent();
                $$var_name->setIdInfoGene($informationGenerale);
                $$var_name->setRefEmploiNonPermanent($EmploiNonPermanent);
                $informationGenerale->getAgentRemuContNonPerm()->add($$var_name);
            }
        }
        if (count($AgentRemunerationContractuelPermanent) === 0) {
            foreach ($RefCategorie as $index => $categorie) {
                $var_name = 'AgentRemunerationContractuelPermanent' . $index;
                $$var_name = new AgentRemunerationContractuelPermanent();
                $$var_name->setIdInfoGene($informationGenerale);
                $$var_name->setRefCategorie($categorie);
                $informationGenerale->getAgentRemuContPerm()->add($$var_name);
            }
        }

        $form = $this->createForm(InformationGeneraleType::class, $informationGenerale);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {




            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            //set id collectivity to the new questionnaires informations generales
            $session = $this->get('session');
            if (null == $session->get('coll_id')) {
                $idColl = $user->getCollectivite()->getIdColl();
            } else {
                $idColl = $session->get('coll_id');
            }

            $collectivite = $em->getRepository('CollectiviteBundle:Collectivite')->find($idColl);
            $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
            
            $enquete = $this->getMonEnquete();
            $informationGenerale->setCollectivite($collectivite);
            $informationGenerale->setEnquete($enquete);

            


            $InformationGenerale = $em->getRepository('ApaBundle:InformationGenerale')->GetInformationGenerale($idColl, $enquete, $campagne->getIdCamp());
            
            if(!empty($InformationGenerale)){
                return $this->redirectToRoute('bilansocialagent_index');
            }else{
                $this->addFlash(
                    'notice', $this->get('translator')->trans('new.informationgenerale.flash')
                );
                
                $em->persist($informationGenerale);
                $em->flush();
                $OpenModal = true;
                return $this->redirectToRoute('bilansocialagent_index');
            }
        }

        return $this->render('@Apa/informationgenerale/new.html.twig', array(
                    'informationGenerale' => $informationGenerale,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a informationGenerale entity.
     *
     */
    public function showAction(InformationGenerale $informationGenerale) {
        if($this->checkIsUserOwnerOf($informationGenerale)){
            $deleteForm = $this->createDeleteForm($informationGenerale);

            return $this->render('@Apa/informationgenerale/show.html.twig', array(
                        'informationGenerale' => $informationGenerale,
                        'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    /**
     * Displays a form to edit an existing informationGenerale entity.
     *
     */
    public function editAction(Request $request, InformationGenerale $informationGenerale) {
        if($this->checkIsUserOwnerOf($informationGenerale)){
            $user = $this->getUser();
            $session = $this->get('session');
            if (null == $session->get('coll_id')) {
                $idCollectivity = $user->getCollectivite()->getIdColl();
            } else {
                $idCollectivity = $session->get('coll_id');
            }
            $em = $this->getDoctrine()->getManager();
            $AgentRemunerationFonctionnaire = $em->getRepository('ApaBundle:AgentRemunerationFonctionnaire')->findByIdInfoGene($informationGenerale);
            $AgentRemunerationContractuelNonPermanent = $em->getRepository('ApaBundle:AgentRemunerationContractuelNonPermanent')->findByIdInfoGene($informationGenerale);
            $AgentRemunerationContractuelPermanent = $em->getRepository('ApaBundle:AgentRemunerationContractuelPermanent')->findByIdInfoGene($informationGenerale);
            $RefCategorie = $em->getRepository('ReferencielBundle:RefCategorie')->findBy(array('blVali' => false));
            $RefEmploiNonPermanent = $em->getRepository('ReferencielBundle:RefEmploiNonPermanent')->findBy(array('blVali' => false));
            $campagne = $em->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
            $enquete = $this->getMonEnquete();



            if (count($AgentRemunerationFonctionnaire) === 0) {
                foreach ($RefCategorie as $index => $categorie) {
                    $var_name = 'AgentRemunerationFonctionnaire' . $index;
                    $$var_name = new AgentRemunerationFonctionnaire();
                    $$var_name->setIdInfoGene($informationGenerale);
                    $$var_name->setRefCategorie($categorie);
                    $informationGenerale->getAgentRemuFonctionnaire()->add($$var_name);
                }
            }

            if (count($AgentRemunerationContractuelNonPermanent) === 0) {
                foreach ($RefEmploiNonPermanent as $index => $EmploiNonPermanent) {
                    $var_name = 'AgentRemunerationContractuelNonPermanent' . $index;
                    $$var_name = new AgentRemunerationContractuelNonPermanent();
                    $$var_name->setIdInfoGene($informationGenerale);
                    $$var_name->setRefEmploiNonPermanent($EmploiNonPermanent);
                    $informationGenerale->getAgentRemuContNonPerm()->add($$var_name);
                }
            }
            if (count($AgentRemunerationContractuelPermanent) === 0) {
                foreach ($RefCategorie as $index => $categorie) {
                    $var_name = 'AgentRemunerationContractuelPermanent' . $index;
                    $$var_name = new AgentRemunerationContractuelPermanent();
                    $$var_name->setIdInfoGene($informationGenerale);
                    $$var_name->setRefCategorie($categorie);
                    $informationGenerale->getAgentRemuContPerm()->add($$var_name);
                }
            }

            $informationColectiviteAgent = $em->getRepository('ApaBundle:InformationColectiviteAgent')->findOneBy(array('collectivite' => $idCollectivity, 'enquete' => $enquete->getIdEnqu()));
            $deleteForm = $this->createDeleteForm($informationGenerale);
            $editForm = $this->createForm(InformationGeneraleType::class, $informationGenerale);
            $editForm->handleRequest($request);
            $checked = false;
            
            if($informationColectiviteAgent !== null){
                $pcOnglets = $informationColectiviteAgent->getPcOnglets();
                $array_pc_bool = $this->getOngletsTabBool($pcOnglets);
                $array_checked_count = $this->checkIfAllOngletsIsSave($array_pc_bool);
                $checked = $array_checked_count['checked'];
            }
           
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash(
                        'notice', $this->get('translator')->trans('edit.informationgenerale.flash')
                );
                return $this->redirectToRoute('bilansocialagent_index');
            }
           
            return $this->render('@Apa/informationgenerale/edit.html.twig', array(
                        'informationGenerales' => $informationGenerale,
                        'informationColectiviteAgent' => $informationColectiviteAgent,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                        'listeAgent' => $checked,
            ));
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    /**
     * Deletes a informationGenerale entity.
     *
     */
    public function deleteAction(Request $request, InformationGenerale $informationGenerale) {
        if($this->checkIsUserOwnerOf($informationGenerale)){
            $form = $this->createDeleteForm($informationGenerale);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($informationGenerale);
                $em->flush();
            }

            return $this->redirectToRoute('bilansocialagent_index');
        }else{
            return $this->redirectToRoute('bilansocialagent_index');
        }
    }

    /**
     * Creates a form to delete a informationGenerale entity.
     *
     * @param InformationGenerale $informationGenerale The informationGenerale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InformationGenerale $informationGenerale) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('informationgenerale_delete', array('idInfogene' => $informationGenerale->getIdinfogene())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
