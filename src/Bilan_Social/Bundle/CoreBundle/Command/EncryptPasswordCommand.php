<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\CoreBundle\Command;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

class EncryptPasswordCommand extends ContainerAwareCommand
{
    /** @staticvar string */
    const APP_NAME = 'Iorga';

    protected $application;

    /** @var InputInterface  */
    protected $input;

    /** @var OutputInterface */
    protected $output;
    
    protected function configure()
    {
        $this
            ->setName('iorga:encryptPassword')
            ->setDescription('Cette commande encrypte en bcrypt les mots de passes situé dans un fichier. et les inserts en base de donnée')
            ->setHelp('');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->progressStart(100);
        $this->input = $input;
        $this->output = $output;

        $output->writeln('');
        $output->writeln('   <info>======================================</>');
        $output->writeln(sprintf('   <info>Installing %s Application.</info>', static::APP_NAME));
        $output->writeln('   <info>======================================</>');
        $output->writeln('');
        
        
        try {
            $this
                    ->databaseConnectionStep($io)
                    ->fileStep($io);
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Error during' . static::APP_NAME . 'installation. %s</error>', $e->getMessage()));
            $output->writeln('');

            return $e->getCode();
        }
    }
    
    
    
    protected function databaseConnectionStep($io) {
        $this->output->writeln(sprintf('<info>==============================================</info>'));
        $this->output->writeln(sprintf('<info>Tentative de connexion a la base de donnee</info>'));
        $this->output->writeln(sprintf('<info>==============================================</info>'));
        $io->progressAdvance(10);
        // Needs to try if database already exists or not
        $connection = $this->getContainer()->get('doctrine')->getConnection();
        try {
            if (!$connection->isConnected()) {
                $connection->connect();
                $this->output->writeln(' <info>Connexion reussie</info>');
            }
        } catch (\PDOException $e) {
            $this->output->writeln(' <error>Echec de connexion a la base de donnée</error>');
        }

        return $this;
    }
    
     /**
     * {@inheritdoc}
     */
    public function runCommand($command, $params = []) {
        $params = array_merge(
                ['command' => $command], $params, $this->getDefaultParams()
        );

        $this->getApplication()->setAutoExit(false);
        $exitCode = $this->getApplication()->run(new ArrayInput($params), $this->output);

        if (0 !== $exitCode) {
            $this->getApplication()->setAutoExit(true);
            $errorMessage = sprintf('The command terminated with an error code: %u.', $exitCode);
            $this->output->writeln("<error>$errorMessage</error>");
            $e = new \Exception($errorMessage, $exitCode);
            throw $e;
        }

        return $this;
    }
    
    /**
     * Get default parameters
     *
     * @return array
     */
    protected function getDefaultParams() {
        $defaultParams = ['--no-debug' => true];

        if ($this->input->hasOption('env')) {
            $defaultParams['--env'] = $this->input->getOption('env');
        }

        if ($this->input->hasOption('verbose') && $this->input->getOption('verbose') === true) {
            $defaultParams['--verbose'] = true;
        }

        return $defaultParams;
    }
    
    protected function fileStep($io){
        $finder = new Finder();
        try {
            $finder->in('imports/depot/');
            $io->progressAdvance(10);
            $this->output->writeln(' <info>Dossier de recherche correctement configure</info>');
        } catch (\PDOException $e) {
            $io->error('Impossible de trouver le dossier de recherche');
        }
        
        if(\count($finder->files()->name('*.csv')) < 1){
            $io->error('Aucun fichier xml present dans le dossier de recherche');
        }else{
            $io->progressAdvance(10);
            $io->success(' <info>Recuperatioon des donnes en cours</info>');
            $requete_update = '';
            foreach ($finder as $file) {
                
                $this->output->writeln($file->getRealPath());
                
                if(!empty($file->getContents())){
                    $row = 1;
                    if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {

                        $tab_infos = array();
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);
                            $row++;
                            for ($c=0; $c < $num; $c++) {
                                $current_line_to_array = str_getcsv($data[$c] , $delimiter = ";");
                                array_push($tab_infos, $current_line_to_array );
                            }
                        }
                        $i = 0;
                        $user = "";
                        $password = "";
                        $len = count($tab_infos);
                        $em = $this->getContainer()->get('doctrine')->getManager();
                        $user_in_base = null;
                        foreach($tab_infos as $key => $tab ){
                            foreach($tab as $key1 => $value ){
                                    
                                    if($key1 == 0){
                                        $user_in_base = $em->getRepository('UserBundle:User')->findOneBy(array('username' => $value));
                                        if(empty($user_in_base)){
                                            $this->output->writeln($value . ' non present en base de donnee');
                                        }
                                       
                                    }
                                    if($key1 == 0){
                                        $user = $value;
                                    }
                                    if($key1 == 1){
                                        $password = password_hash($value, PASSWORD_BCRYPT);
                                    }
                            }
                            if($user_in_base != null && !empty($user_in_base)){
                                $requete_update .= "UPDATE `utilisateur` SET `PASSWORD` = '". $password ."' WHERE USERNAME = '" . $user . "';\n";
                            }
                            
                                if ($i !== $len - 1) {
                                        $user .= ',';
                                        $password .= ',';
                                }
                                $i++;
                        }
                        
                        
                        
                        fclose($handle);
                    }
                }else{
                    $io->error('le fichier ' . $file->getRelativePathname() . ' est vide');
                }
            }
            $this->output->writeln($requete_update);
            $confirm = $io->confirm("voulez vous lancer l'update?");
                        if($confirm){
                            
                            $stmt = $this->getContainer()->get('doctrine')->getConnection()->prepare($requete_update);
                           try {
                                $stmt->execute();
                                $io->success('Mise a jour reussie');
                                $io->progressFinish();
                                
                            } catch (\PDOException $e) {
                                 $io->error("Erreur lors de l'update");
                            }
                        }else{
                             $io->warning("Annulation demander par l'utilisateur");
            }
        }
    }
}