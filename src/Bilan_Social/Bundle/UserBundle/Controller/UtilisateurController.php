<?php

namespace Bilan_Social\Bundle\UserBundle\Controller;

use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg;
use Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits;
use Bilan_Social\Bundle\UserBundle\Entity\Profil;
use Bilan_Social\Bundle\UserBundle\Form\UserType;
use Bilan_Social\Bundle\UserBundle\Form\EditProfilType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Bilan_Social\Bundle\CoreBundle\Model\ConfigDynamicClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bilan_Social\Bundle\UserBundle\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Common\Collections\ArrayCollection;

class UtilisateurController extends AbstractBSController {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $infoCdgs = [];
        $utilisateurs = $em->getRepository('UserBundle:User')->listeUtilisateursCdg();
        foreach ($utilisateurs as $util) {
            $tabCdgs = array();
            $username = $util->getUsername();
            $idUtil = $util->getIdUtil();
            $histoConn = $em->getRepository('UserBundle:HistoriqueConnexion')->findBy(array('idUtil' => $idUtil), array('dtConn' => 'DESC'), '1');
            if(!empty($histoConn)){
                $infoCdgs[$idUtil]['dernConn'] = $histoConn[0]->getDtConn();
            }else{
                $infoCdgs[$idUtil]['dernConn'] = null;
            }
            $infoCdgs[$idUtil]['dtConn'] = $util->getDtLastConn();
            $infoCdgs[$idUtil]['roles'] = $util->getRoles();
            $infoCdgs[$idUtil]['username'] = $username;
            $infoCdgs[$idUtil]['departements'] = [];
            $infoCdgs[$idUtil]['referents'] = [];

            if ($util->hasRole('ROLE_CDG')) {
                $utilCdgs = $util->getUtilisateurCdgs();
                $departementIds = $em->getRepository('CollectiviteBundle:CdgDepartement')->getOriginDepartementsByCdgUtilisateur($util->getIdUtil());
                foreach ($utilCdgs as $utilCdg) {
                    $cdg = $utilCdg->getCdg();
                    array_push($tabCdgs, $cdg->getIdCdg());
    
                    $CdgReferent = $em->getRepository('CollectiviteBundle:Cdg')->GetReferentFormulaireCdg($tabCdgs, $departementIds);
                    $droits = $em->getRepository('UserBundle:UtilisateurDroits')->findByUtilisateurCdg($utilCdg->getIdUtilisateurCdg());
                    if (!empty($droits)) {
                        if (!empty($CdgReferent)) {
                            foreach ($CdgReferent as $ref) {
                                $infoCdgs[$idUtil]['referents'][] = $ref->getLbCdg();
                            }
                        }
                        else {
                            $infoCdgs[$idUtil]['referents'] = [];
                        }
                    }
    
                    $departements = $em->getRepository('CollectiviteBundle:CdgDepartement')->findBy(array('cdg' => $cdg, 'fgType' => 0));
                    foreach ($departements as $dept){
                        if(!in_array($dept->getDepartement()->getLbDepa(), $infoCdgs[$idUtil]['departements'])){
                            $infoCdgs[$idUtil]['departements'][] = $dept->getDepartement()->getLbDepa();
                        }
                    }
                }
            } elseif ($util->hasRole('ROLE_INFOCENTRE')) {
                $departements = $util->getDepartements();
                foreach($departements as $departement) {
                    $infoCdgs[$idUtil]['departements'][] = $departement->getLbDepa();
                }
            }
        }
        return $this->render('@User/Utilisateur/index.html.twig', array('utilisateurs' => $infoCdgs));
    }

    public function ficheAction(Request $request,$id = null){
        $em = $this->getDoctrine()->getManager();
        $encoder = $this->container->get('security.password_encoder');
        $current_user = $this->getUser();
        $cdgs = $em->getRepository('CollectiviteBundle:Cdg')->findAll();
        $profils = $em->getRepository('UserBundle:Profil')->findAll();
        $utilCdg = null;
        $typeUtil = null;
        $referents = null;
        $utilDroits = null;
        $droits = [];
        $departements = null;
        $enregistrement = 'ok';
        $postDroits = [];
        if($id == null){
            $user = new User();
        }else{
            $user = $em->getRepository('UserBundle:User')->findOneByIdUtil($id);
            $current_psw = $user->getPassword();
            $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($user);
            $utilDroits = $em->getRepository('UserBundle:UtilisateurDroits')->findByUtilisateurCdg($utilCdg->getIdUtilisateurCdg());
            $droits = $this->getDroits($utilDroits);
            $cdg = $utilCdg->getCdg();
            $departements = $em->getRepository('CollectiviteBundle:CdgDepartement')->findBy(array('cdg' => $cdg, 'fgType' => 0));
            if(count($utilDroits) > 1){
                $typeUtil = 'Utilisateur référent';
                $departement = $utilDroits[0]->getCdgDepartement()->getDepartement();
                $referents = $em->getRepository('CollectiviteBundle:Cdg')->getCdgReferent($cdg, $departement);
            }elseif(count($utilDroits) == 1){
                $typeUtil = 'Utilisateur départemental';
                $departement = $utilDroits[0]->getCdgDepartement()->getDepartement();
                $referents = $em->getRepository('CollectiviteBundle:Cdg')->getCdgReferent($cdg,$departement);
            }elseif(count($utilDroits) == 0){
                if(count($departements) > 1){
                    $typeUtil = 'Utilisateur référent';
                }else{
                    $typeUtil = 'Utilisateur départemental';
                }
            }
        }

        if(!empty($_POST)){
            $data = $_POST;
            foreach ($data as $k => $v){
                if (strpos($k, 'slide') !== false) {
                    $key = explode('_',$k);
                    $postDroits[$key[2]][$key[1]] = $v;
                }
            }
        }

        $hasRoleInfocentre = $current_user->hasRole('ROLE_INFOCENTRE');
        $form = $this->createForm(UserType::class, $user, array('hasRoleInfocentre' => $hasRoleInfocentre));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $_POST;
            if($data['bilan_social_user']['profil'] == 'cdg'){

                $em->getConnection()->beginTransaction(); // suspend auto-commit
                try {
                    if(isset($data['bilan_social_user']['cdgs'])){
                        $nmCdg = $data['bilan_social_user']['cdgs'];
                    }elseif(isset($data['nmCdg'])){
                        $nmCdg = $data['nmCdg'];
                    }
                    $slides = [];
                    $bit = null;
                    foreach ($data as $k => $v){
                        $key = explode('_',$k);
                        if($key[0] === "slide"){
                            if($key[1] == 'comptecoll' || $key[1] == 'gestenqu'){
                                switch ($v){
                                    case 0:
                                        $bit = '00';
                                        break;
                                    case 1:
                                        $bit = '10';
                                        break;
                                    case 2:
                                        $bit = '11';
                                        break;
                                }
                            }else{
                                $bit = $v;
                            }
                            $slides[$key[2]][] = $bit;
                        }
                    }
                    $psw = $user->getPassword();
                    if($id == null){
                        $hashPasswordUser = $encoder->encodePassword($user, $psw);
                        $user->setPassword($hashPasswordUser);
                        $user->setCreatedAt(new \DateTime());
                        $user->setCdUtilcrea($current_user->getUsername());
                        $user->setRoles([User::ROLE_CDG]);
                    }else{
                        if($psw == null){
                            $user->setPassword($current_psw);
                        }else{
                            $hashPasswordUser = $encoder->encodePassword($user, $psw);
                            $user->setPassword($hashPasswordUser);
                        }
                        $user->setUpdatedAt(new \DateTime());
                        $user->setCdUtilcrea($current_user->getUsername());
                    }
                    $em->persist($user);
                    $em->flush();

                    if($id == null){
                        $utilCdg = new UtilisateurCdg();
                    }
                    $cdgUtil = $em->getRepository('CollectiviteBundle:Cdg')->findOneByNmCdg($nmCdg);
                    $utilCdg->setUtilisateur($user);
                    $utilCdg->setCdg($cdgUtil);
                    $em->persist($utilCdg);
                    $em->flush();

                    if($departements == null){
                        $departements = $em->getRepository('CollectiviteBundle:CdgDepartement')->findBy(array('cdg' => $cdgUtil, 'fgType' => 0));
                    }
                    foreach($departements as $d){
                        $utilDroits = $em->getRepository('UserBundle:UtilisateurDroits')->findOneBy(array('cdgDepartement' => $d, 'utilisateurCdg' => $utilCdg));
                        if($utilDroits == null){
                            $utilDroits = new UtilisateurDroits();
                            $utilDroits->setCdgDepartement($d);
                            $utilDroits->setUtilisateurCdg($utilCdg);
                        }
                        $cdgDeptBits = isset($slides[$d->getIdCdgDepartement()]) ? $slides[$d->getIdCdgDepartement()] : null;
                        if($cdgDeptBits!=null){
                            $bits = implode("", $cdgDeptBits);
                            $fgDroits = bindec($bits);
                        }else{
                            $bits = "0000000";
                            $fgDroits = bindec($bits);
                        }
        //foreach ($slides as $key => $value){
        //    if($d->getIdCdgDepartement() == $key){
        //        $bits = implode("", $value);
        //        $fgDroits = bindec($bits);
        //    }
        //}
                        $utilDroits->setFgDroits($fgDroits);
                        $em->persist($utilDroits);
                    }
                    $em->flush();

                    $em->getConnection()->commit();
                    $enregistrement = 'ok';
                }
                catch (UniqueConstraintViolationException $e) {
                    $em->getConnection()->rollBack();
                    $enregistrement = 'nok';
                    if($e->getErrorCode() == '1062'){
                        $this->addFlash('error', 'Un utlisateur possède déjà cet identifiant, veuillez le modifier.');
                    }else{
                        $this->addFlash('error', 'Une erreur est survenue, veuillez recommencer.');
                    }
                }
            }elseif($data['bilan_social_user']['profil'] == 'infocentre'){
                $em->getConnection()->beginTransaction(); // suspend auto-commit
                try {
                    if(isset($data['bilan_social_user']['profils'])){
                        $nomProfil = $data['bilan_social_user']['profils'];
                    }elseif(isset($data['nomProfil'])){
                        $nomProfil = $data['nomProfil'];
                    }
                    $psw = $user->getPassword();
                    if($id == null){
                        $hashPasswordUser = $encoder->encodePassword($user, $psw);
                        $user->setPassword($hashPasswordUser);
                        $user->setCreatedAt(new \DateTime());
                        $user->setCdUtilcrea($current_user->getUsername());
                        $user->setRoles([User::ROLE_INFOCENTRE]);
                    }else{
                        if($psw == null){
                            $user->setPassword($current_psw);
                        }else{
                            $hashPasswordUser = $encoder->encodePassword($user, $psw);
                            $user->setPassword($hashPasswordUser);
                        }
                        $user->setUpdatedAt(new \DateTime());
                        $user->setCdUtilcrea($current_user->getUsername());
                    }

                    $em->persist($user);
                    $em->flush();

                    $em->getConnection()->commit();
                    $enregistrement = 'ok';
                }
                catch (UniqueConstraintViolationException $e) {
                    $em->getConnection()->rollBack();
                    $enregistrement = 'nok';
                    if($e->getErrorCode() == '1062'){
                        $this->addFlash('error', 'Un utlisateur possède déjà cet identifiant, veuillez le modifier.');
                    }else{
                        $this->addFlash('error', 'Une erreur est survenue, veuillez recommencer.');
                    }
                }
            }
            elseif($data['bilan_social_user']['profil'] == 'admin'){

                $em->getConnection()->beginTransaction(); // suspend auto-commit
                try {
                    //
                    $psw = $user->getPassword();
                    $hashPasswordUser = $encoder->encodePassword($user, $psw);
                    $user->setPassword($hashPasswordUser);
                    $user->setCreatedAt(new \DateTime());
                    $user->setCdUtilcrea($current_user->getUsername());
                    $user->setRoles([User::ROLE_ADMIN]);
                    $em->persist($user);
                    $em->flush();

                    $em->getConnection()->commit();
                    $enregistrement = 'ok';
                }
                catch (UniqueConstraintViolationException $e) {
                    $em->getConnection()->rollBack();
                    $enregistrement = 'nok';
                    if($e->getErrorCode() == '1062'){
                        $this->addFlash('error', 'Un utlisateur possède déjà cet identifiant, veuillez le modifier.');
                    }else{
                        $this->addFlash('error', 'Une erreur est survenue, veuillez recommencer.');
                    }
                }
            }

            if($enregistrement == 'ok'){
                if($id != null){
                    $this->addFlash('notice', 'La modification a bien été effectuée.');
                }else{
                    $this->addFlash('notice', 'L\'ajout a bien été effectué.');
                }
                if($data['bilan_social_user']['profil'] == 'cdg') {
                    return $this->redirectToRoute('utilisateur_fiche', array('id' => $user->getIdUtil()));
                }
                if($data['bilan_social_user']['profil'] == 'infocentre') {
                    return $this->redirectToRoute('user_infocentre_edit', array('id' => $user->getIdUtil()));
                }
            }
        }

        return $this->render('@User/Utilisateur/fiche.html.twig',array(
            'form'          => $form->createView(), 
            'cdgs'          => $cdgs, 
            'departements'  => $departements,
            'droits'        => $droits, 
            'postDroits'    => $postDroits,
            'profils'       => $profils, 
            'referents'     => $referents, 
            'utilCdg'       => $utilCdg, 
            'utilDroits'    => $utilDroits, 
            'typeUtil'      => $typeUtil
        ));
    }

    public function gestionProfilAction(Request $request){
        try{
            $em = $this->getDoctrine()->getManager();
            $profils = $em->getRepository('UserBundle:Profil')->findAll();
            $utilisateur = $this->getUser();
            $profil_repo = $this->getEntityManager()->getRepository('UserBundle:Profil');
            $profils = $profil_repo->findAll();
            $export_admin = $this->getEntityManager()->getRepository('CoreBundle:exportAdmin')->findByType(20);

            $profil = new Profil();
            $form_create_profil = $this->createForm(EditProfilType::class, $profil);
            $form_create_profil->handleRequest($request);
            $form = $form_create_profil->createView();

            return $this->render('@User/Utilisateur/gestionProfil.html.twig', array('profils' => $profils, 'export_admin' => $export_admin, 'form' => $form));
        }catch(Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }

    public function editUserInfoCentreAction(Request $request, User $user) {
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->getUser();
        $hasRoleInfocentre = $currentUser->hasRole('ROLE_INFOCENTRE');
        $currentPassword = $user->getPassword();
        $encoder = $this->container->get('security.password_encoder');
        
        $editForm = $this->createForm(UserType::class, $user, array('hasRoleInfocentre' => $hasRoleInfocentre));

        $editForm->remove('cdgs');
        $editForm->remove('profil');
        if ($currentUser->hasRole('ROLE_INFOCENTRE')) {
            $editForm->remove('profils');
        }

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $newPassword = $editForm->getData()->getPassword();

            $em->getConnection()->beginTransaction(); // suspend auto-commit
            try {
                $psw = $user->getPassword();
                if($newPassword == null){
                    $user->setPassword($currentPassword);
                }else{
                    $hashPasswordUser = $encoder->encodePassword($user, $psw);
                    $user->setPassword($hashPasswordUser);
                }
                $user->setUpdatedAt(new \DateTime());

                $em->persist($user);
                $em->flush();

                $em->getConnection()->commit();
            }
            catch (UniqueConstraintViolationException $e) {
                $em->getConnection()->rollBack();
                if($e->getErrorCode() == '1062'){
                    $this->addFlash('error', 'Un utlisateur possède déjà cet identifiant, veuillez le modifier.');
                }else{
                    $this->addFlash('error', 'Une erreur est survenue, veuillez recommencer.');
                }
            }

            $em->flush();
            $this->addFlash('notice', 'La modification a bien été effectuée.');

            return $this->redirectToRoute('user_infocentre_edit', array(
                'id' => $user->getIdUtil()
            ));
        }

        return $this->render('@User/Utilisateur/user_infocentre_edit.html.twig', array(
            'editForm' => $editForm->createView()
        ));
    }

    public function getLbCdgAjaxAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $nmCdg = $request->get('nmCdg');
        $this->saveAndUnlockSession($request);
        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findOneByNmCdg($nmCdg);
        $lbCdg = $cdg->getLbCdg();

        $response = new Response();
        $response->setContent($lbCdg);

        return $response;
    }

    public function getUsernameAjaxAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $username = $request->get('username');
        $this->saveAndUnlockSession($request);
        $res = $em->getRepository('UserBundle:User')->getLastUsername($username);
        if(!empty($res)){
            $lastUsername = $res['0']['username'];
            $lastUsernameArr = explode("_", $lastUsername);
            $idUsername = $lastUsernameArr[1] + 1;
        }else{
            $idUsername = 1;
        }

        $response = new Response();
        $response->setContent($idUsername);

        return $response;
    }

    public function getDepartementsAjaxAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $nmCdg = $request->get('nmCdg');
        $id = $request->get('id');
        $postDroits = $request->get('droits');
        $this->saveAndUnlockSession($request);
        $droits = [];
        $submit = true;
        if(!empty($postDroits) && $postDroits != ''){
            $droits = $postDroits;
        }elseif($id != ''){
            $user = $em->getRepository('UserBundle:User')->findOneByIdUtil($id);
            $utilCdg = $em->getRepository('UserBundle:UtilisateurCdg')->findOneByUtilisateur($user);
            $utilDroits = $em->getRepository('UserBundle:UtilisateurDroits')->findByUtilisateurCdg($utilCdg->getIdUtilisateurCdg());
            $droits = $this->getDroits($utilDroits);
        }

        $cdg = $em->getRepository('CollectiviteBundle:Cdg')->findOneByNmCdg($nmCdg);
        $departements = $em->getRepository('CollectiviteBundle:CdgDepartement')->findBy(array('cdg' => $cdg, 'fgType' => 0));

        $template = $this->renderView('@User/Utilisateur/droits.html.twig', array('departements' => $departements, 'droits' => $droits));
        if(empty($departements)){
            $submit = false;
        }

        $json = json_encode(array($submit,$template));
        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    private function getDroits($utilDroits){
        $droits = [];
        foreach ($utilDroits as $d){
            $fgDroits = $d->getFgDroits();
            $droitsBit = decbin($fgDroits);

            if($droitsBit != 0){
                // ajout de 0 à gauche sur 7 caracteres
                $droitsBit = str_pad($droitsBit, 7, "0", STR_PAD_LEFT);

                $droitsBitArr = str_split($droitsBit);
                $droits[$d->getCdgDepartement()->getIdCdgDepartement()] = [];
                $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['comptecoll'] = $droitsBitArr[0].$droitsBitArr[1];
                if($droits[$d->getCdgDepartement()->getIdCdgDepartement()]['comptecoll'] == '00')
                    $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['comptecoll'] = '0';
                if($droits[$d->getCdgDepartement()->getIdCdgDepartement()]['comptecoll'] == '10')
                    $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['comptecoll'] = '1';
                if($droits[$d->getCdgDepartement()->getIdCdgDepartement()]['comptecoll'] == '11')
                    $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['comptecoll'] = '2';
                $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['gestenqu'] = $droitsBitArr[2].$droitsBitArr[3];
                if($droits[$d->getCdgDepartement()->getIdCdgDepartement()]['gestenqu'] == '00')
                    $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['gestenqu'] = '0';
                if($droits[$d->getCdgDepartement()->getIdCdgDepartement()]['gestenqu'] == '10')
                    $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['gestenqu'] = '1';
                if($droits[$d->getCdgDepartement()->getIdCdgDepartement()]['gestenqu'] == '11')
                    $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['gestenqu'] = '2';
                $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['placecoll'] = $droitsBitArr[4];
                $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['mail'] = $droitsBitArr[5];
                $droits[$d->getCdgDepartement()->getIdCdgDepartement()]['analyse'] = $droitsBitArr[6];

            }
        }
        return $droits;
    }
    
    public function changePasswordByUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $trans = $this->get('translator');
        $user = $this->getUser();
        $user_copy = clone $user;
        $form = $this->createForm(ChangePasswordType::class, $this->getUser(), array(
                'validation_groups' => array('Default', 'required-password'),
                'attr' => array('class' => 'form-reset')
        ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $hashPasswordUser = $encoder->encodePassword($user, $form->get('password')->getData());
            $oldPassword = $form->get('oldPassword')->getData();
            if($encoder->isPasswordValid($user_copy,$oldPassword)){
                $user->setPassword($hashPasswordUser);
                $em->flush();
                $this->addFlash('notice', $trans->trans("success.changePwd.flash"));
                return $this->redirectToRoute('homepage'); 
            }else{
                $user->setPassword($user_copy->getPassword());
                $em->flush();
                $this->addFlash('error', $trans->trans("erreur.changePwd.falseOldPwd.flash"));
            }
        }
        
        return $this->render('@User/Security/changePassword.html.twig', array(
                        'form' => $form->createView(),
            ));
    }

    public function createProfilAction(Request $request){
        try{
            $em = $this->getEntityManager();
            $user_repo = $this->getEntityManager()->getRepository('UserBundle:User');
            $current_user = $user_repo->findOneBy(array('idUtil'=>$this->getUser()->getIdUtil()));
            $nom_profil = $request->get('new_profil_name');
            $profil = new Profil();
            $form_edit_profil = $this->createForm(EditProfilType::class, $profil);
            $form_edit_profil->handleRequest($request);
            $form_edit = $form_edit_profil->createView();
            if($form_edit_profil->isSubmitted() && $form_edit_profil->isValid()){
                $em->persist($profil);
                $em->flush();
                $id_new_profil = $profil->getIdProfil();
            }

            return $this->redirectToRoute('utilisateur_gestion_profil');
        }catch(Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }

    public function deleteProfilAction(Request $request){
        try{
            $id_profil_to_delete = $request->get('id_profil_to_delete');
            $profil_repo = $this->getEntityManager()->getRepository('UserBundle:Profil');
            $profil_to_delete = $profil_repo->find($id_profil_to_delete);
            $em = $this->getEntityManager();
            $em->remove($profil_to_delete);
            $em->flush();
            $json = json_encode(array('success' => true));
            $response = new Response($json);
            return $response;
        }catch(\Exception $e){
            /*dump($e->getMessage());
            exit();*/
        }
    }

    public function profilExportAdminAction(Request $request){
        try{
            $new_profil_export_admin = $request->get('new_profil_export_admin');
            $remove_profil_export_admin = $request->get('remove_profil_export_admin');
            $em = $this->getDoctrine()->getEntityManager();
            $profil_repo = $em->getRepository('UserBundle:Profil');
            $exportAdmin_repo = $em->getRepository('CoreBundle:exportAdmin');
            foreach ($new_profil_export_admin as $n_p_e_a){
                $id_profil_add = $n_p_e_a[0];
                $id_export_admin_add = $n_p_e_a[1];
                $profil_add = $profil_repo->find($id_profil_add);
                $export_admin_add = $exportAdmin_repo->find($id_export_admin_add);
                $export_admin_add->addProfil($profil_add);
                $profil_add->addExportsAdmin($export_admin_add);
            }
            foreach ($remove_profil_export_admin as $r_p_e_a){
                $id_profil_remove = $r_p_e_a[0];
                $id_export_admin_remove = $r_p_e_a[1];
                $profil_remove = $profil_repo->findOneBy(array('idProfil'=>$id_profil_remove));
                $export_admin_remove = $exportAdmin_repo->findOneBy(array('id'=>$id_export_admin_remove));
                $export_admin_remove->removeProfil($profil_remove);
                $profil_remove->removeExportsAdmin($export_admin_remove);
            }
            $em->flush();
        }catch(\Exception $e){
          /*  dump($e->getMessage());
            exit();*/
        }
        return new JsonResponse($new_profil_export_admin);   
    }

}