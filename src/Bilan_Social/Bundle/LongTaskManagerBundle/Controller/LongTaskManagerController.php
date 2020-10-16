<?php

namespace Bilan_Social\Bundle\LongTaskManagerBundle\Controller;

use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Bilan_Social\Bundle\LongTaskManagerBundle\Entity\LongTaskHeader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LongTaskManagerController extends AbstractBSController
{
	public function getUserTaskAction(Request $Request,$serialize = false){
		$bsltm = $this->get('long_task_manager');
        $bsltm_configs = $this->getFromConfigFile('data_weel_bsltm');
        $bsltm_config = $bsltm_configs['db_repository'];
        $em_bsltm = $this->getDataWellBsltmConnection('repository');
        $bsltm->hydrate($bsltm_config,null,$em_bsltm);
		$list = $bsltm->list(array(
		  "ownerKey"=> $this->getUser()->getIdUtil(),
		  "taskType"=> 0,
		  "statusMask"=> 111
		));
		foreach ($list as $key => $task) {
            $task = $list[$key];
            $task->setFicheView($this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task)));//$this->render('@LongTaskManager/fiche.html.twig',array('task'=>$task,'file_manager'=>$this->get('file_manager.file_manager')));
            $this->copyTaskAwayToLocal($task);
            if($serialize==true) $task = serialize($task);
            $list[$key] = $task;
        }
		return new JsonResponse($list);
	}

	public function getStatusTaskAction(Request $Request){
		$task_key = $Request->get('task_key');
        $nm_annee = $Request->get('nm_annee',"2017");
        $bsltm = $this->get('long_task_manager');
        $bsltm_configs = $this->getFromConfigFile('data_weel_bsltm');
        $bsltm_config = $bsltm_configs['db_repository'];
        $em_bsltm = $this->getDataWellBsltmConnection('repository');
        if($bsltm_config!=null){
            $bsltm->hydrate($bsltm_config,null,$em_bsltm);
        }
		$task = $bsltm->status(array(
			"taskKey"=>$task_key
		));
		if($task==null){
            $bsltm = $this->get('long_task_manager');
            $task = $bsltm->status(array(
                "taskKey"=>$task_key
            ));
        }else{
            $this->copyTaskAwayToLocal($task);
        }
        if($task!=null){
            $task->setFicheView($this->forward('LongTaskManagerBundle:LongTaskManager:getTaskFiche', array('task' => $task))->getContent());//$this->render('@LongTaskManager/fiche.html.twig',array('task'=>$task,'file_manager'=>$this->get('file_manager.file_manager')))->getContent();
        }
		return new JsonResponse($task);
	}

	public function getTaskFileContentAction(Request $Request,$fileKey=null){
		$file_key = $Request->get('file_key',$fileKey);
		return $this->forward('CoreBundle:AbstractBS:getFileContent',array('fileKey'=>$file_key));
	}

    public function getTaskFileAction(Request $Request){
        $current_campagne = $this->getEntityManager()->getRepository('CampagneBundle:Campagne')->getCurrentCampagne();
        $current_annee = $current_campagne!==null ? $current_campagne->getNmAnne() : null;
        $bsltm_configs = $this->getFromConfigFile('data_weel_bsltm');
        $bsltm_config = $bsltm_configs['db_repository'];
        $em_annee = $current_annee!=null ? $this->getDataWellConnection($current_annee) : null;
        $bsltm = $this->get('long_task_manager');
        $bsltm->hydrate($bsltm_config,null,$em_annee);
        $task_keys = $Request->get('task_keys');
        $temp_task_keys = is_array($task_keys) ? $task_keys : json_decode($task_keys,true);
        $task_keys = $temp_task_keys!=null ? $temp_task_keys : $task_keys;
        $task_keys = is_array($task_keys) ? $task_keys : array($task_keys);
        $zip = new \ZipArchive();
        $fileManager = $this->getBSFileManager();
        // The name of the Zip documents.
        $zipName = 'export.zip';
        $zip->open($zipName,  \ZipArchive::OVERWRITE|\ZipArchive::CREATE);
        foreach ($task_keys as $key => $task_key) {
            $task = $bsltm->status(array(
                "taskKey"=>$task_key
            ));
            $fileKey = $task->getFileKey();
            if($fileKey!=null){
                $file_index_key = $key;
                if(isset($task->lth_away)){
                   $lth = $task->lth_away;
                   $file_index_key = $lth->getRefYear();
                   $file_index_key = empty($file_index_key) ? $key : $file_index_key; 
                } 
                $fileInfo = $fileManager->getFileInfos($fileKey);
                $fileContent = $fileManager->getFileContent($fileKey);
                $filename = $file_index_key.'_'.$fileInfo['json_response']['originalFileName'];
                $fileBody = fopen($fileContent['body'],'rb');
                file_put_contents($filename, $fileBody);
                $zip->addFile($filename);
            }
        }
        $zip->close();
        $response = new Response(file_get_contents($zipName));
        $response->headers->set('Content-Type', 'application/zip');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $zipName . '"');
        $response->headers->set('Content-length', filesize($zipName));

        return $response;
    }

	public function getTaskFileUrlAction(Request $Request){
		$file_key = $Request->get('file_key');
		$bsfm = $this->get('file_manager');
		$file_url = $bsfm->getFileUrl($file_key);
		$response =  new JsonResponse(array('file_url'=>$file_url));
        return $response;
	}

	public function cancelDeleteTaskAction(Request $Request){
        $em = $this->getEntityManager();
		$task_key = $Request->get('task_key');
        $task_status = $Request->get('task_status');
        $bsltm = $this->get('long_task_manager');
        $nm_annee = 2017;
        $bsltm_2017 = clone $bsltm;
        $bsltm_2017 = $this->getDataWellBsltm($nm_annee, $bsltm_2017);
        $deleted = '';
        $canceled = '';
        $canceled_2017 = '';
        $deleted_2017 = '';
        $task_item = $em->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneBy(array('task_key' => $task_key));
        if ($task_status == "FINISHED") {
            $params = array(
                "taskKey" => $task_key
            );
            $deleted = $bsltm->delete($params);
            $deleted_2017 = $bsltm_2017->delete($params);
            $em->remove($task_item->getPoolExport());
            $em->remove($task_item);
            $em->flush();
        }
        else {
            $params = array(
                "taskKey" => $task_key
            );
            $canceled = $bsltm->cancel($params);
            $canceled_2017 = $bsltm_2017->cancel($params);
        }

        return new JsonResponse(array($canceled,$deleted,$canceled_2017,$deleted_2017));
	}

	public function deleteExportHrgAction(Request $Request){
        $em = $this->getEntityManager();
        $fileManager = $this->getBSFileManager();
        
        $pool_export_id = $Request->get('pool_export_id');
        $pool_export = $em->getRepository('InfoCentreBundle:PoolExport')->findOneById($pool_export_id);
        $header_export = $em->getRepository('AnalyseBundle:HeaderExportHRG')->findOneByPoolExport($pool_export);
        $file_keys = $header_export->getFileKeys();

        try {

        	foreach($file_keys as $file_key) {
                $fileManager->deleteFile($file_key->getFileKey(), false, true);
            }

            $em->remove($header_export);
            $em->remove($pool_export);
            $em->flush();
        } catch (\Exception $e) {
            error_log($e->getMessage());

            return new JsonResponse(
                array(
                    'success'   => false,
                    'error'     => $e->getMessage()
                )  
            );
        }
        
        return new JsonResponse(
            array(
                'success' => true
            )
        );
	}

    public function deleteFailedTaskAction(Request $Request) {
        $task_key = $Request->get('task_key');
        $task_status = $Request->get('task_status');
        $response = '';

        if ($task_status == "RUN_FAILED" || $task_status == "ABORTED") {
            $nm_annee = 2017;
            $em = $this->getEntityManager();
            
            $task_item = $em->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneBy(array('task_key' => $task_key));
            $pool_export = $em->getRepository('InfoCentreBundle:PoolExport')->findOneByTaskKeyNativeQuery($task_key);
            if($task_item!=null){
                if($pool_export!=null){
                    $pool_export->removeLongTaskHeader($task_item);
                    if(empty($pool_export->getLongTaskHeaders())) $em->remove($pool_export);
                }
                $em->remove($task_item);
                $em->flush();
            }
            $em_annee = $this->getDataWellConnection($nm_annee);
            $task_item = $em_annee->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneBy(array('task_key' => $task_key));
            if($nm_annee>2017){
                $pool_export = $em_annee->getRepository('InfoCentreBundle:PoolExport')->findOneByTaskKeyNativeQuery($task_key);
            }else{
                $pool_export = null;
            }
            if($task_item!=null){
                if($pool_export!=null){
                    $pool_export->removeLongTaskHeader($task_item);
                    if(empty($pool_export->getLongTaskHeaders())) $em_annee->remove($pool_export);
                }
                $em_annee->remove($task_item);
                $em_annee->flush();
            }
            $response = 'success';
        }

        return new JsonResponse($response);
    }

    public function getTaskFicheAction(Request $Request){
		$task = $Request->get('task');
		return $this->render('@LongTaskManager/fiche.html.twig',array('task'=>$task,'file_manager'=>$this->get('file_manager.file_manager')));
	}

	public function getTaskRatioAction(Request $Request){
        $task_key = $Request->get('task_key');
        $bsltm = $this->get('long_task_manager');
        $task = $bsltm->status(array(
            "taskKey"=> $task_key
        ));
        $ratio = ($task->getDetailDoneCount() + $task->getDetailsErrorCount()) / $task->getDetailsCount() * 100;

        return $ratio;

    }

    public function getUriFileAction($taskKey){
        $fileManager = $this->getBSFileManager();
        $uri = $fileManager->getPublicFileUrl($taskKey);
        return $uri;
    }

    public function copyTaskAwayToLocal($task_away){
        $task_key = $task_away->getTaskKey();
        $lth_away = isset($task_away->lth_away) ? $task_away->lth_away : $task_away ;
        $em = $this->getEntityManager();
        $lth = $em->getRepository('LongTaskManagerBundle:LongTaskHeader')->findOneBy(array('task_key' => $task_key));
        $current_status = $lth!=null ? $lth->getStatus() : null;
        $status_to_exclude = array(
            LongTaskHeader::numStatusFromCode("FINISHED"),
            LongTaskHeader::numStatusFromCode("INIT_FAILED"),
            LongTaskHeader::numStatusFromCode("RUN_FAILED"),
            LongTaskHeader::numStatusFromCode("ABORTED")
        );
        $new = $current_status === null;
        if(!$new && !in_array($current_status, $status_to_exclude)){
            $lth = !$new ? $lth : new LongTaskHeader();
            if($new){
                $copy_startDate = new \DateTime($task_away->startDate);
                $lth->setOwnerKey($lth_away->getOwnerKey());
                $lth->setStartDate($copy_startDate);
                $lth->setTaskKey($task_away->taskKey);
                $lth->setTaskType($lth_away->getTaskType());
                $lth->setRunData($lth_away->getRunData());
                $lth->setDetailsCount($task_away->detailsCount);
                $lth->setOwnerEmail($lth_away->getOwnerEmail());
            }
            
            $copy_end_date = new \DateTime($task_away->endDate);
            $copy_status = LongTaskHeader::numStatusFromCode($task_away->status);
            
            $lth->setStatus($copy_status);
            $lth->setEndDate($copy_end_date);
            $lth->setStatusLinkedData($task_away->statusLinkedData);
            $lth->setExternalRefId($lth_away->getExternalRefId());
            $lth->setDetailsCountDone($task_away->detailsDoneCount);
            $lth->setDetailsErrorCount($task_away->detailsErrorCount);
            $em->persist($lth);
            $em->flush();
        }
    }
}