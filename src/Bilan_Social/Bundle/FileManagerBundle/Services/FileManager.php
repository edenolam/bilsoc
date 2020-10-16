<?php

namespace Bilan_Social\Bundle\FileManagerBundle\Services;

use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier;
use Doctrine\DBAL\ConnectionException;

/**
 * Service FileManager => utilisation de BSFM
 *
 */
class FileManager extends AbstractBSController
{
    const ERR_UPLOAD_VIRUS = 100;
    const ERR_UPLOAD_FILE_ALREADY_EXISTS = 200;
    const ERR_UPLOAD_DB = 300;

    const ERR_IMPREVUE = 900;
    const ERR_IMPREVUE_CALL_WS = 910;
    const ERR_IMPREVUE_IN_WS = 920;

    private $BSFM_SERVICE_ROOT_URL;
    private $BSFM_PUBLIC_URL_MASK;
    private $BSFM_FILE_URL_MASK;

    private $currentUser;

    public function __construct($params, $em, $tokenStorage)
    {
        $this->BSFM_SERVICE_ROOT_URL = $params['service_root_url'];
        $this->BSFM_PUBLIC_URL_MASK = $params['public_url_mask'];
        $this->BSFM_FILE_URL_MASK = $params['file_url_mask'];

        $this->setEM($em);
        $this->currentUser = $tokenStorage->getToken()!=null ? $tokenStorage->getToken()->getUser() : null;
    }

    public function getUser()
    {
        return $this->currentUser;
    }

    private function internal_do_upload_file($url, $data, $cdgs = null)
    { 
        $json_data = $data['data'];
        $response = array(
            'isOk' => false,
            'errCause' => null,
            'errMsg' => null,
            'fichier' => null,
        );
        if ($json_data == null) {
            $response['errCause'] = self::ERR_IMPREVUE;
            $response['errMsg'] = 'Aucune donnée à sauvegarder';
            return $response;
        }

        $jsonResponse = array();
        $httpStatus = null;
        try {
            // On utilise curl pour réaliser les appels aux Webservices.
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_TIMEOUT, 295); //timeout in seconds
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
            $httpResponse = curl_exec($curl);
            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            $jsonResponse = json_decode($httpResponse, true);
        } catch (Exception $ex) {
            $response['errCause'] = self::ERR_IMPREVUE_CALL_WS;
            $response['errMsg'] = $jsonResponse['message'];
            return $response;
        }

        // Traitement en fonction du code HTTP de retour
        if ($httpStatus == 200 && !empty($jsonResponse)) {
            // Ecriture des informations fichier dans la table BS proxy fichier
            try {
                // Récupération connexion base
                $em = $this->getEntityManager();
                try {
                    $fileKey = $jsonResponse['fileKey'];
                    $logicalFolder = $jsonResponse['logicalFolder'];
                    $targetYear = $jsonResponse['targetYear'];
                    $ownerKey = $jsonResponse['ownerKey'];
                    $to_collectivite = isset($data['to_collectivite']) ? $data['to_collectivite'] : null;
                    $fichier = $em->getRepository('FileManagerBundle:Fichier')->findOneBy(array('fileKey' => $fileKey));
                    
                    if ($fichier == null) {
                        $em->getConnection()->beginTransaction();
                        $fichier = new Fichier();
                        $fichier->setFileKey($fileKey);
                        $fichier->setTargetYear($targetYear);
                        $fichier->setLogicalFolder($logicalFolder);
                        $fichier->setOwnerKey($ownerKey);
                        
                        if($cdgs !== null){
                            foreach ($cdgs as $key => $value) {
                                $cdgDepartements = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByCdg($value);
                                if (!empty($cdgDepartements) && sizeof($cdgDepartements) > 0) {
                                    foreach ($cdgDepartements as $key => $cdgDepartement) {
                                        if (!empty($cdgDepartement)) {
                                            $cdgDepartement->addFichier($fichier);
                                            $fichier->addCdgDepartement($cdgDepartement);
                                        }
                                    }
                                }
                            }
                        }else if(!$this->getUser()->hasRole('ROLE_ADMIN')){
                            if ($this->getUser()->hasRole('ROLE_CONSOLE')) {

                            } else {
                                $monCdg = $this->getMonCDG();
                                if ($monCdg != null) {
    
                                    if($to_collectivite !== null){
                                        $to_collectivite->addFichier($fichier);
                                        $fichier->addCollectivite($to_collectivite);
                                    }else{
                                        $cdgDepartements = $em->getRepository('CollectiviteBundle:CdgDepartement')->getDepartementsByCdg($monCdg);
                                        if (!empty($cdgDepartements) && sizeof($cdgDepartements) > 0) {
                                            foreach ($cdgDepartements as $key => $cdgDepartement) {
                                                if (!empty($cdgDepartement)) {
                                                    $cdgDepartement->addFichier($fichier);
                                                    $fichier->addCdgDepartement($cdgDepartement);
                                                }
                                            }
                                        }
                                    }
                                }else{
                                    $collectivite = $this->getUser()->getCollectivite();
                                    $collectivite->addFichier($fichier);
                                    $fichier->addCollectivite($collectivite);
                                }
                            }
                        }
                        

                        $em->persist($fichier);
                        $em->flush();
                        $em->getConnection()->commit();

                        $response['isOk'] = true;
                        $response['fichier'] = $fichier;
                    } else {
                        $response['errCause'] = self::ERR_UPLOAD_FILE_ALREADY_EXISTS;
                        $response['errMsg'] = $jsonResponse['message'];
                    }
                } catch (\Exception $ex) {
                    error_log($ex->getLine());
                    error_log($ex->getMessage());
                    $em->getConnection()->rollBack();
                    $response['errCause'] = self::ERR_UPLOAD_DB;
                    $response['errMsg'] = $ex;
                }
            } catch (ConnectionException $e) {
                error_log($e->getLine());
                error_log($e->getMessage());
                $this->addFlash('error', $e);
                $response['errCause'] = self::ERR_UPLOAD_DB;
                $response['errMsg'] = $e;
            }
        } else if ($httpStatus == 409) {
            $response['errCause'] = self::ERR_UPLOAD_VIRUS;
            $response['errMsg'] = $jsonResponse['message'];
        } else if ($httpStatus == 504){
             $response['errCause'] = self::ERR_UPLOAD_VIRUS;
            $response['errMsg'] = "Le serveur n'a pas repondu dans le délai imparti, si le problème persite contactez votre administrateur.";
        }else {
            $response['errCause'] = self::ERR_IMPREVUE_IN_WS;
//          $response['errMsg'] = $httpStatus . ' : ' . $jsonResponse['message'];
            $response['errMsg'] = "une erreur est survenue veuillez réessayer, si le problème persite contactez votre administrateur.";
        }
        return $response;
    }

    /** Envoi un fichier privé "standard" au BSFM
     * @param $folder   nom du dossier logique de dépot (tirroir)
     * @param $json_data    données descriptives du fichier à écrire
     * @return array        données descriptives complétes du fichier ecris
     */
    public function uploadFileInFolder($folder, $json_data)
    {
        // Construction de l'URL permettant de déposer un fichier dans un dossier spécial pour TALEND
        $url = $this->BSFM_SERVICE_ROOT_URL . 'folders/' . $folder . '/files';
        return $this->internal_do_upload_file($url, $json_data);
    }

    /** Envoi un fichier privé "special" au BSFM
     * @param $specialFolder    nom du dossier logique de dépot (tirroir)
     * @param $json_data        données descriptives du fichier à écrire
     * @return array            données descriptives complétes du fichier ecris
     */
    public function uploadFileInSpecialFolder($specialFolder, $json_data)
    {
        // Construction de l'URL permettant de déposer un fichier dans un dossier spécial pour TALEND
        $url = $this->BSFM_SERVICE_ROOT_URL . 'special-folders/' . $specialFolder . '/files';
        return $this->internal_do_upload_file($url, $json_data);
    }

    /** Envoi un fichier "public" au BSFM
     * @param $publicFolder     nom du dossier logique de dépot (tirroir)
     * @param $json_data        données descriptives du fichier à écrire
     * @return array            données descriptives complétes du fichier ecris
     */
    public function uploadFileInPublicFolder($publicFolder, $json_data, $cdgs = null)
    {
        // Construction de l'URL permettant de déposer un fichier dans un dossier spécial pour TALEND
        $url = $this->BSFM_SERVICE_ROOT_URL . 'public-folders/' . $publicFolder . '/files';
        return $this->internal_do_upload_file($url, $json_data, $cdgs);
    }

    public function prepareFileToAdd($fileObj, $isAttachment = true, $externalRef = null, $options = null)
    {
        $to_return = array();
        $options = is_array($options) ? $options : array();
        $to_collectivite = isset($options['collectivite']) ? $options['collectivite'] : null;
        if (empty($fileObj->getPathname())) {
            return null;
        }
        // On construit les données à envoyer au WebService
        $data = array();
        $contents = file_get_contents($fileObj->getPathname());
        $xml_base64 = base64_encode($contents);

        $data['fileContent'] = $xml_base64;
        if($this->getUser()->hasRole('ROLE_CONSOLE')){
            $data['ownerKey'] = "CONSOLE -" . rand(1,10000);
        }else{
            $monCdg = $this->getMonCDG();
            if ($monCdg != null) {
                if($to_collectivite!=null){
                    $data['ownerKey'] = "COLL-" . $to_collectivite->getIdColl();
                    $to_return['to_collectivite'] = $to_collectivite;
                }else{
                    $data['ownerKey'] = "CDG-" . $monCdg->getIdCdg();
                }
            } else {
                $maColl = $this->getUser()->getCollectivite();
                if ($maColl != null) {
                    $data['ownerKey'] = "COLL-" . $maColl->getIdColl();
                } else {
                    $data['ownerKey'] = "ADMIN";
                }
            }
        }
        $data['fileContentType'] = !empty($fileObj->getClientMimeType()) ? $fileObj->getClientMimeType() : 'application/octet-stream';
        if(!empty($options['DGCL'])){
            $data['originalFileName'] = $options['DGCL'];
        }else{
            $data['originalFileName'] = !empty($fileObj->getClientOriginalName()) ? $fileObj->getClientOriginalName() : 'fichier';
        }
        if(isset($options['annee'])){
            $data['targetYear'] = $options['annee'];
        }else{
            $data['targetYear'] = $this->getMaCampagne() != null ? $this->getMaCampagne()->getNmAnne() : 0;
        }

        $data['status'] = 0;
        $data['externalRef'] = $externalRef;
        $data['isAttachment'] = $isAttachment;
        $to_return['data']=json_encode($data);
        return $to_return;
    }

    /**
     * @param $fileKey
     * @return array
     */
    public function getFileInfos($fileKey)
    {
        $url = $this->BSFM_SERVICE_ROOT_URL . 'fileInfos/' . $fileKey;
        $response = array();
        try {
            // On utilise curl pour réaliser les appels aux Webservices.
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPGET, true);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            // On récupère la réponse
            $response['status'] = $status;
            $response['json_response'] = json_decode($json_response, true);
        } catch (Exception $ex) {
            $response['status'] = 500;
            $response['json_response'] = null;
        }
        return $response;
    }

    /** Récupére depuis BSFM le contenu du fichier correspondant à la clé donnée
     * @param $urlFileManager   root URL du service BSFM
     * @param $fileKey          clé du fichier demandé
     * @return array|mixed
     */
    public function getFileContent($fileKey)
    {
        $url = $this->BSFM_SERVICE_ROOT_URL . 'fileInfos/' . $fileKey . '/getContent';
        $response = array();
        $timeout = 30;
        try {
            // On utilise curl pour réaliser les appels aux Webservices.
            $curl = curl_init($url);
            //curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_HTTPGET, true);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            //$body = substr($json_response, $header_size);
            $url = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
            curl_close($curl);

            // On récupère la réponse
            $response['status'] = $status;
            $response['json_response'] = json_decode($json_response, true);
            $response['body'] = $url;
        } catch (Exception $ex) {
            $response['status'] = 500;
            $response['json_response'] = null;
        }
        return $response;
    }

    /**
     * @param $fileKey
     * @return mixed
     */
    public function getFileUrl($fileKey)
    {
        return str_replace('{fileKey}', $fileKey, $this->BSFM_FILE_URL_MASK);
    }

    /**
     * @param $fileKey
     * @return mixed
     */
    public function getFileUrlFull($fileKey)
    {
        return $this->BSFM_SERVICE_ROOT_URL .''.str_replace('{fileKey}', $fileKey, $this->BSFM_FILE_URL_MASK);
    }

    /**
     * @param $fileKey
     * @return mixed
     */
    public function getPublicFileUrl($fileKey)
    {
        return str_replace('{fileKey}', $fileKey, $this->BSFM_PUBLIC_URL_MASK);
    }

    /** Suppression d'un fichier du NAS et de la table de proxy-fichier
     * @param $fileKey
     * @param bool $isSoftDelete
     * @return array
     */
    public function deleteFile($fileKey, $isSoftDelete = false, $isExportHRG = false)
    {
        $url = $this->BSFM_SERVICE_ROOT_URL . 'fileInfos/' . $fileKey;
        if ($isSoftDelete) $url = $url . '/soft';

        $response = array(
            'isOk' => false,
            'errCause' => null,
            'errMsg' => null,
        );
        $jsonResponse = array();
        $httpStatus = null;
        try {
            // On utilise curl pour réaliser les appels aux Webservices.
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $httpResponse = curl_exec($curl);
            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $jsonResponse = json_decode($httpResponse, true);
        } catch (Exception $ex) {
            $response['errCause'] = self::ERR_IMPREVUE_CALL_WS;
            $response['errMsg'] = $jsonResponse['message'];
            return $response;
        }

        // Traitement en fonction du code HTTP de retour
        if ($httpStatus == 200 && !empty($jsonResponse)) {
            // Suppression des informations fichier dans la table BS proxy fichier
            try {
                // Récupération connexion base
                $em = $this->getEntityManager();

                try {
                    if ($isExportHRG == false) {
                        $em->getConnection()->beginTransaction();
                        $fichier = $em->getRepository('FileManagerBundle:Fichier')->findOneByFileKey($fileKey);
                        $collectivites = $fichier->getCollectivite();
                        foreach ($collectivites as $collectivite) {
                            $fichier->removeCollectivite($collectivite);
                            $collectivite->removeFichier($fichier);
                            $em->persist($collectivite);
                        }
    
                        $em->remove($fichier);
                        $em->flush();
                        $em->getConnection()->commit();
                    }

                    $response['isOk'] = true;
                } catch (\Exception $ex) {
                    error_log($ex->getTraceAsString(), 0);
                    error_log($ex->getMessage(), 0);
                    error_log($ex->getLine(), 0);
                    $em->getConnection()->rollBack();
                    $response['errCause'] = self::ERR_UPLOAD_DB;
                    $response['errMsg'] = $ex;
                }
            } catch (ConnectionException $e) {
                error_log($e->getTraceAsString(), 0);
                error_log($e->getMessage(), 0);
                error_log($e->getLine(), 0);
                $this->addFlash('error', $e);
                $response['errCause'] = self::ERR_UPLOAD_DB;
                $response['errMsg'] = $e;
            }
        } else if ($httpStatus == 409) {
            $response['errCause'] = self::ERR_UPLOAD_VIRUS;
            $response['errMsg'] = $jsonResponse['message'];
        } else if ($httpStatus == 504){
            $response['errCause'] = self::ERR_UPLOAD_VIRUS;
            $response['errMsg'] = "Le serveur n'a pas repondu dans le délai imparti, si le problème persite contactez votre administrateur.";
        }else {
            $response['errCause'] = self::ERR_IMPREVUE_IN_WS;
            $response['errMsg'] = "une erreur est survenue veuillez réessayer, si le problème persite contactez votre administrateur.";
        }
        return $response;
    }
}
