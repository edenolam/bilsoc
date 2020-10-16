<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\AnalyseBundle\Entity\HeaderExportHRG;

class ExportHRGCommand extends ContainerAwareCommand {
    
    protected function configure(){
        $this->setName('iorga:export-hrg')
            ->setDescription('Exécute l\'export HRG pour une ou plusieurs collectivités.')
            ->setHelp('Exécute l\'export HRG pour une ou plusieurs collectivités.')
            ->addArgument('codeExport', InputArgument::REQUIRED, 'Code de l\'export permettant de récupérer les infos d\'un header')
            ->addArgument('idPool', InputArgument::REQUIRED, 'Identifiant de l\'échantillon');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $codeExport = $input->getArgument('codeExport');
        $container = $this->getContainer();
        $kernel = $container->get('kernel');
        $today = getDateNow('Y-m-d');//date_format('now','Y-m-d');
        $log_dir = $kernel->getProjectDir().'/var/logs/'.$kernel->getEnvironment().'/';
        $log_file_name = 'cmd_export_hrg_'.$today.'.log';
        $log_file_full_name = $log_dir.$log_file_name;
        /*
        *   initailisation du traitement
        */
        
        // $em = $container->get("doctrine.orm.entity_manager");
        // $hehrg_repo = $em->getRepository(HeaderExportHRG::class);
        // $hehrg = $hehrg_repo->findOneBy(array('codeExport'=>$codeExport));
        // $id_pool = $hehrg->getPoolExport()->getPool()->getId();
        /*
        *   creation de l'utilisateur
        */
        $user = new User();
        $roles = array_merge($user->getRoles(),array('ROLE_INFOCENTRE', 'ROLE_CDG', 'ROLE_CONSOLE'));
        $user->setRoles($roles);
        $user->setUsername('console');
        $token = new UsernamePasswordToken(
            $user,
            null,
            'main',
            $roles
        );

        $container->get('security.token_storage')->setToken($token);

        /*
        *   Lancement du traitement
        */

        $msg = array("============","Export en cours","code export : ".$codeExport);
        file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));

        $output->writeln($msg);
        $service = $container->get('analyse_controller');
        $request = Request::createFromGlobals();
        $request->attributes->set('id_pool', $input->getArgument('idPool'));
        $request->attributes->set('log_file_full_name', $log_file_full_name);
        $action = $service->callExportHRGAction($request, $input->getArgument('codeExport'));
        $response = $action->getStatusCode();
        
        
        if($response == 200){
            $msg = array($action->getContent(),"Export terminé pour le code export ".$codeExport,"============");
            /*$output->writeln([
            $action->getContent(),
            '',
            '============',
            'Export terminé',
            ]);*/
        }else{
            $msg = array("ERREUR - Export en erreur pour le code export ".$codeExport,$action->getContent(),"============");
        }
        file_log_error($log_file_full_name,$msg,array('prefix'=>$codeExport));
        $output->writeln($msg);        
    }
}



