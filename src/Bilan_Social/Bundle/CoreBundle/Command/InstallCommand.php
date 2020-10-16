<?php

namespace Bilan_Social\Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 *
 * Installer command application
 *
 */
class InstallCommand extends ContainerAwareCommand {

    /** @staticvar string */
    const APP_NAME = 'Iorga';

    protected $application;

    /** @var InputInterface  */
    protected $input;

    /** @var OutputInterface */
    protected $output;

    /**
     * {@inheritdoc}
     */
    protected function configure() {
        $this
                ->setName('iorga:install')
                ->setDescription(sprintf('%s Application Installer.', static::APP_NAME))
                ->addOption('force', null, InputOption::VALUE_NONE, 'Force installation');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->input = $input;
        $this->output = $output;

        $output->writeln('');
        $output->writeln('   <info>======================================</>');
        $output->writeln(sprintf('   <info>Installing %s Application.</info>', static::APP_NAME));
        $output->writeln('   <info>======================================</>');
        $output->writeln('');

        try {
            $this
                    ->databaseStep()
                    ->fixturesStep();
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Error during' . static::APP_NAME . 'installation. %s</error>', $e->getMessage()));
            $output->writeln('');

            return $e->getCode();
        }

        $output->writeln('');
        $output->writeln('===================================');
        $io = new SymfonyStyle($input, $output);
        $io->success(sprintf('%s Application has been successfully installed.', static::APP_NAME));
        $output->writeln('===================================');

        return 0;
    }

    /**
     * Step where the database is built, the fixtures loaded and some command scripts launched
     *
     * @return InstallCommand
     */
    protected function databaseStep() {
        $this->output->writeln(sprintf('<info>Prepare database schema</info>'));

        // Needs to try if database already exists or not
        $connection = $this->getContainer()->get('doctrine')->getConnection();
        try {
            if (!$connection->isConnected()) {
                $connection->connect();
            }
            $this->runCommand('doctrine:database:drop', ['--force' => true]);
        } catch (\PDOException $e) {
            $this->output->writeln(' <error>Database does not exist yet</error>');
        }

        $this->runCommand('doctrine:database:create');

        $this
                ->runCommand('doctrine:schema:create')
                ->runCommand(
                        'doctrine:schema:update', ['--force' => true, '--no-interaction' => true]
        );

        return $this;
    }

    /**
     * Load Fixtures Data
     *
     * @return InstallCommand
     */
    protected function fixturesStep() {
        $this->output->writeln('<info>' . static::APP_NAME . ' install fixtures</info>');

        $this->runCommand('doctrine:fixtures:load', ['--append' => true]);

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

}
