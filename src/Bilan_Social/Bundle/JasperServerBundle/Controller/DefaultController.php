<?php

namespace Bilan_Social\Bundle\JasperServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;

class DefaultController extends AbstractBSController
{
    public function indexAction()
    {
        return $this->render('@JasperServer/Default/index.html.twig');
    }

    public function jasperReportTestAction(Request $request){
        $user= $this->getUser();
        if($user->hasRole('ROLE_COLLECTIVITY')){
        	$em = $this->getEntityManager();
        	$id_coll = $user->getCollectivite()->getIdColl();
        	$campagneCourante = $em->getRepository('CampagneBundle:Campagne')->GetCurrentCampagne();
        	$enquete = $em->getRepository('EnqueteBundle:Enquete')->getEnqueteActive($id_coll, $campagneCourante->getIdCamp());
	        $id_enqu = $enquete->getIdEnqu();
	        $controls = array(
	           'id_coll' => $id_coll,
	           'id_enqu' => $id_enqu
	        );
	        $bs_report_id = $this->getParameter('jasper_bs_report_id');
            $bs_report_path = $this->getParameter('jasper_bs_report_path');
            
	        $report = $this->get('jasperreport.reportservice')->runReport($bs_report_path.$bs_report_id, 'pdf',null,null,$controls);

	        $response = new Response($report);
	        $response->headers->set('Content-type', 'application/pdf');
	        $response->headers->set('Content-Disposition', 'inline; filename=Report.pdf');
	        $response->headers->set('Cache-Control', 'must-revalidate');

	        return $response;
        }
        return new Response();
    }
}
