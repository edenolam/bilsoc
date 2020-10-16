<?php

namespace Bilan_Social\Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Question\Question;

/**
 *
 * Installer command application
 *
 */
class DeleteFileBSFMCommand extends ContainerAwareCommand 
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
            ->setName('iorga:DeleteFileBSFM')
            ->setDescription('Cette commande supprime les fichiers base carrieres concernant un CDG en particulier')
            ->setHelp('');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');
        $io->progressStart(100);
        $this->input = $input;
        $this->output = $output;

        $output->writeln('');
        $output->writeln('   <info>======================================</>');
        $output->writeln(sprintf('   <info>Installing %s Application.</info>', static::APP_NAME));
        $output->writeln('   <info>======================================</>');
        $output->writeln('');
        
        
        try {
            $question = new Question("Entrez l'id CDG à traiter", 'idCdg');
            $io->newLine();
            $question->setValidator(function ($answer) {
            if (!is_numeric($answer) || $answer == null) {
                    throw new \RuntimeException(
                            "Vous devez entrer un id (valeur numerique)"
                    );
                }

                return $answer;
            });
            $question->setMaxAttempts(2);
            
             $idCdg = $helper->ask($input, $output, $question);
            $this
                    ->databaseConnectionStep($io)
                    ->fileStep($io,$idCdg);
            
            
            
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
    
    protected function fileStep($io, $idCdg = null){
        $file_manager = $this->getApplication()->getKernel()->getContainer()->get('file_manager.file_manager');
        
        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $liste_fichiers = $em->getRepository('FileManagerBundle:Fichier')->findFichiersByOwner($idCdg);
        
        $confirm = $io->confirm("voulez vous lancer la suppression des ". count($liste_fichiers) ." fichiers ?");
        if($confirm){
                foreach ($liste_fichiers as $key => $value) {
                    try {
                        $file_manager->deleteFile($value->getFileKey());
                        $io->success('suppression réussi du fichier = ' . $value->getFileKey());
                    } catch (\PDOException $e) {
                         $io->error("Erreur");
                    }
                }

        }else{
             $io->warning("Annulation demander par l'utilisateur");
        }
        
    }
}