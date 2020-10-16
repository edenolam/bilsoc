<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller{
    private $em = null;
    protected $container = null;
    
    public function __construct(EntityManager $em, ContainerInterface $container) {
        $this->em = $em;
        $this->container = $container;
    }
    
    public function encodepasswordAction($manual = false, $enquete = null){
        $em = $this->em;
        $encoder = $this->container->get('security.password_encoder');
        if ($manual) {
            if ($enquete != null && !empty($enquete)) {
                $result = $em->getRepository('EnqueteBundle:Enquete')->findOneByIdEnqu($enquete->getIdEnqu());
                $dtDebu = $result->getDtDebu()->format('Y-m-d');
                $idEnqu = $result->getIdEnqu();
                $cdgDepartements = $result->getCdgDepartements();
                $cdgDepartementIds = array();
                foreach ($cdgDepartements as $cdgDepartement) {
                    $cdgDepartementIds = $cdgDepartement->getIdCdgDepartement();
                }
                $enquColl = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->getEnqueteCollectiviteByCdg($idEnqu,$cdgDepartementIds);
                foreach($enquColl as $coll){
                    $idColl = $coll['idColl'];
                    $userColl = $em->getRepository('UserBundle:User')->findOneByCollectivite($idColl);
                    if ($userColl != null && !empty($userColl)) {
                        $passTemp = $userColl->getLbPassTemp();
                        if(null != $passTemp && !empty($passTemp)){
                            $hashPasswordUser = $encoder->encodePassword($userColl, $passTemp);
                            $userColl->setPassword($hashPasswordUser);
                            $userColl->setLbPassTemp(null);
                            try{
                                $em->persist($userColl);
                            } catch (Exception $ex) {
                                return $ex->getMessage();
                            }
                        }
                    }
                }
            }
        } else {
            $results = $em->getRepository('EnqueteBundle:Enquete')->findAll(); 
            $dt = new \DateTime('now');
            $today = $dt->format('Y-m-d');
            
            foreach ($results as $res){
                $dtDebu = $res->getDtDebu()->format('Y-m-d');
                $idEnqu = $res->getIdEnqu();
                $cdgDepartements = $res->getCdgDepartements();
                $cdgDepartementIds = array();
                foreach ($cdgDepartements as $cdgDepartement) {
                    $cdgDepartementIds = $cdgDepartement->getIdCdgDepartement();
                }
                //$idCdg = $res->getCdg()->getIdCdg();
                if($today == $dtDebu || $manual == true){
                    //récup les collectivité associées à l'enquête
                    $enquColl = $em->getRepository('EnqueteBundle:EnqueteCollectivite')->getEnqueteCollectiviteByCdg($idEnqu,$cdgDepartementIds);
                    foreach($enquColl as $coll){
                        $idColl = $coll['idColl'];
                        $userColl = $em->getRepository('UserBundle:User')->findByCollectivite($idColl);
                        foreach ($userColl as $uc){
                            $passTemp = $uc->getLbPassTemp();
                            if(null != $passTemp){
                                $hashPasswordUser = $encoder->encodePassword($uc, $passTemp);
                                $uc->setPassword($hashPasswordUser);
                                $uc->setLbPassTemp(null);
                                try{
                                    $em->persist($uc);
                                } catch (Exception $ex) {
                                    return $ex->getMessage();
                                }
                            }
                        }
                    }
                }
            }
        }
        
        try{
            $em->flush();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        
        $response = new Response();
        $response->setContent('done');
        
        return $response;
    }
}