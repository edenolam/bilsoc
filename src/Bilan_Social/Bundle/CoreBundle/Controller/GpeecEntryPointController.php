<?php

namespace Bilan_Social\Bundle\CoreBundle\Controller;

use DateTime;
use Bilan_Social\Bundle\CoreBundle\Controller\AbstractBSController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Exception;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;

class GpeecEntryPointController extends AbstractBSController
{
    private $key;

    public function indexAction(string $targetRoute){

        $user = $this->getUser()->getUsername();
        $entrypointData = $this->_encryptData($user, $targetRoute, 'Accèder à GPEEC');
        $entrypointUrl = $this->getParameter('GPEEC_ENTRYPOINT_URL');

        return $this->redirect($entrypointUrl . '?d=' . $entrypointData['d'] . '&n=' . $entrypointData['n']);
    }

    /**
     * @param string $username
     * @param string $target
     * @param string|null $label
     * @return array
     * @throws Exception MODE DEV ONLY Génére l'url de point entrée GPEEC pour simuler clic sur lien dans BS
     */
    private function _encryptData(string $username, string $target, string $label){
        $now = new DateTime();
        $data = [
            'username' => $username,
            'targetRoute' => $target,
            'timestamp' => $now->getTimestamp(),
        ];

        $key = pack("H*", $this->getParameter('ENTRYPOINT_KEY') );
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $ciphertext = sodium_crypto_secretbox(json_encode($data), $nonce, $key);

        return [
            'd' => bin2hex($ciphertext),
            'n' => bin2hex($nonce),
            'l' => $label,
        ];
    }

}
