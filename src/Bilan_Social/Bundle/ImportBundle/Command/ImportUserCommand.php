<?php

namespace Bilan_Social\Bundle\ImportBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportUserCommand extends ContainerAwareCommand {

    /**
     * {@inheritdoc}
     */
    protected function configure() {
        $this
                ->setName('bilan_social:import:user')
                ->setDescription('Import users from CSV file');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        // Showing when the script is launched
        $now = new \DateTime();
        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' </comment>');

        // Importing CSV on DB via Doctrine ORM
        $this->import($input, $output);

        // Showing when the script is over
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' </comment>');
    }

    /**
     * Import users
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function import(InputInterface $input, OutputInterface $output) {
        $import = $this->getContainer()->get('bs.import.user.step');
        $importedItem = $import->execute();

        $output->writeln('<info>' . $importedItem . ' imported users</info>');
    }

}
