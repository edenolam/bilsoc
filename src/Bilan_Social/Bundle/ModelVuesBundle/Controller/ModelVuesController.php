<?php

namespace Bilan_Social\Bundle\ModelVuesBundle\Controller;

use Bilan_Social\Bundle\ModelVuesBundle\Entity\ModelVues;
use Bilan_Social\Bundle\ModelVuesBundle\Form\ModelVuesType;
use Doctrine\ORM\ORMException;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ModelVuesController extends AbstractBSController
{
    public function indexAction()
    {
        return $this->render('@ModelVues/ModelVues/index.html.twig');
    }
    public function enqueteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository('ModelVuesBundle:ModelVues')->findOneByCdModelVues('ENQU');
        if(empty($modele)){
            $modele = new ModelVues();
        }
        
        $form = $this->createForm(ModelVuesType::class, $modele);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $modele->setCdModelVues('ENQU');
            
            $em->getConnection()->beginTransaction();
            try{
                $em->persist($modele);
                $em->flush();
                $em->getConnection()->commit();
                $this->addFlash('notice',$this->get('translator')->trans('ajout.modelvues.flash'));
            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('error',$this->get('translator')->trans('erreur.modelvues.flash'));
            }
            
        }
        
        return $this->render('@ModelVues/ModelVues/enquete.html.twig', array('form' => $form->createView()));
    }
    public function collectiviteAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $modele = $em->getRepository('ModelVuesBundle:ModelVues')->findOneByCdModelVues('COLL');
        if(empty($modele)){
            $modele = new ModelVues();
        }
        
        $form = $this->createForm(ModelVuesType::class, $modele);
        $form->remove('blBilaSoci');
        $form->remove('blRass');
        $form->remove('blHand');
        $form->remove('blGpee');
        $form->remove('blGpeecPlus');
        $form->remove('fgStat');
        $form->remove('blApa');
        $form->remove('blCons');
        $form->remove('blN4ds');
        $form->remove('blBaseCarr');
        $form->remove('blBilaSociVide');
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $modele->setCdModelVues('COLL');
            
            $em->getConnection()->beginTransaction();
            try{
                $em->persist($modele);
                $em->flush();
                $em->getConnection()->commit();
                $this->addFlash('notice',$this->get('translator')->trans('ajout.modelvues.flash'));
            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('error',$this->get('translator')->trans('erreur.modelvues.flash'));
            }
            
        }
        
        return $this->render('@ModelVues/ModelVues/collectivite.html.twig', array('form' => $form->createView()));
    }
    public function rechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $modele = $em->getRepository('ModelVuesBundle:ModelVues')->findOneByCdModelVues('RECH');
        if(empty($modele)){
            $modele = new ModelVues();
        }
        
        $form = $this->createForm(ModelVuesType::class, $modele);
        $form->remove('blBilaSoci');
        $form->remove('blRass');
        $form->remove('blHand');
        $form->remove('blGpee');
        $form->remove('blGpeecPlus');
        $form->remove('fgStat');
        $form->remove('blApa');
        $form->remove('blCons');
        $form->remove('blN4ds');
        $form->remove('blBaseCarr');
        $form->remove('blBilaSociVide');
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $modele->setCdModelVues('RECH');
            
            $em->getConnection()->beginTransaction();
            try{
                $em->persist($modele);
                $em->flush();
                $em->getConnection()->commit();
                $this->addFlash('notice',$this->get('translator')->trans('ajout.modelvues.flash'));
            } catch (ORMException $ex) {
                $em->getConnection()->rollBack();
                error_log("Error Message ". $ex->getMessage(),0);
                $this->addFlash('error', "Une erreur est survenue durant la mise à jour des données. " . $ex->getMessage());
            }
            
        }
        
        return $this->render('@ModelVues/ModelVues/recherche.html.twig', array('form' => $form->createView()));
    }
    public function analyseAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository('ModelVuesBundle:ModelVues')->findOneByCdModelVues('ANAL');
        if(empty($modele)){
            $modele = new ModelVues();
        }
        
        $form = $this->createForm(ModelVuesType::class, $modele);
        /*$form->remove('blBilaSoci');
        $form->remove('blRass');
        $form->remove('blHand');
        $form->remove('blGpee');
        $form->remove('blApa');
        $form->remove('blCons');
        $form->remove('blN4ds');
        $form->remove('blBaseCarr');
        $form->remove('blBilaSociVide');*/

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $modele->setCdModelVues('ANAL');
            
            $em->getConnection()->beginTransaction();
            try{
                $em->persist($modele);
                $em->flush();
                $em->getConnection()->commit();
                $this->addFlash('notice',$this->get('translator')->trans('ajout.modelvues.flash'));
            } catch (Exception $ex) {
                $em->getConnection()->rollBack();
                $this->addFlash('error',$this->get('translator')->trans('erreur.modelvues.flash'));
            }
            
        }
        
        return $this->render('@ModelVues/ModelVues/modifModel.html.twig', array('view_name'=>'Gestion des analyses','form' => $form->createView()));
    }
    public function getModelVuesAjaxAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        $vue = $request->get('vue');
        $this->saveAndUnlockSession($request);
        $colonnes = [];
        $colonnes['module'] = 0;        
        $colonnes['saisie'] = 0;
        $colonnes['import'] = 0;
        $modele = $em->getRepository('ModelVuesBundle:ModelVues')->findOneByCdModelVues($vue);
        $fields = $em->getClassMetadata('ModelVuesBundle:ModelVues')->getFieldNames();
        foreach ($fields as $key => $value) {
            $method = 'get' . ucfirst($value);
            if (method_exists($modele, $method)) {
                $colonne = $modele->{$method}();
                if($colonne === true){
                    $colonnes[] = $value;
                    if ($value == 'blBilaSoci' || $value == 'blRass' || $value == 'blHand' || $value == 'blGpee' || $value == 'blGpeecPlus') {
                        $colonnes['module'] += 1;
                    }
                    if($value == 'blApa' || $value == 'blCons'){
                        $colonnes['saisie'] += 1;
                    }
                    if($value == 'blN4ds' || $value == 'blBaseCarr'){
                        $colonnes['import'] += 1;
                    }
                }
            }
        }
        return new JsonResponse($colonnes);
    }
}
