<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Bilan_Social\Bundle\UserBundle\Entity\User;

class PasswordCommand extends ContainerAwareCommand{
    
    protected function configure(){
        $this->setName('iorga:reinit-mdp')
            ->setDescription('Attribue les mots de passes temporaires aux collectivités.')
            ->setHelp('Cette commande attribue les mots de passes temporaires aux collectivité lors de l\'ouverture d\'une enquête.');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $service = $container->get('password_controller');
        
        $user = new User('console','test',array('ROLE_CONSOLE'));
        $token = new UsernamePasswordToken(
            $user,
            null,
            'main',
            $user->getRoles());

        $container->get('security.token_storage')->setToken($token);
        
        $output->writeln([
            'Reinitialisation des mots de passe des collectivite',
            '============',
            '',
        ]);
        
        $action = $service->encodepasswordAction();
        
        $response = $action->getContent();
        if('done' == $response){
            $output->writeln([
            '',
            '============',
            'reinitialisation effectuee',
        ]);
        }
        
        
    }
}



