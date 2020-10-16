<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Description of ReferencielExporter
 *
 * @author mbusson
 */
class ReferencielExporter extends Controller {

    protected $container = null;
    private $em = null;

    public function __construct(EntityManager $em, ContainerInterface $container) {
        $this->em = $em;
        $this->container = $container;
    }

    public function exportReferenciel($information) {

        //Connexion à la base de données avec le service database_connection

        $conn = $this->container->get('database_connection');

        //Requête
        $results = $conn->query($information['requete_sql']);


        $response = new StreamedResponse();
        $response->setCallback(function() use($results, $information ) {

            $handle = fopen('php://output', 'w+');

            fputs($handle, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

// Nom des colonnes du CSV
            fputcsv($handle, $information['champ'], ';');


            //Champs
            while ($row = $results->fetch()) {
                $tab = array();
                foreach ($information['champ'] as $key => $value) {
                    array_push($tab, $row[$value]);
                }
                fputcsv($handle, $tab, ';');
            }

            fclose($handle);
        });


        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $information['filename'] . '.csv"');

        return $response;
    }

}
