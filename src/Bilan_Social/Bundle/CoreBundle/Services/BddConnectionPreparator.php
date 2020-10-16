<?php

namespace Bilan_Social\Bundle\CoreBundle\Services;


use Symfony\Component\Config\Definition\Exception\Exception;
use PDO;

/**
 * Service BddConnectionPreparator
 *
 * Permet de retourner une connection PDO ou doctrine en fonction de l'année donnée
 *
 */
class BddConnectionPreparator
{
    private $config_base_path = __DIR__.'/../Resources/config/';
    private $jsonFile = 'config.json';
    private $em;
    private $token_storage;
    private $user;
    private $user_bdd;
    private $host_bdd;
    private $name_bdd;
    private $port_bdd;
    private $password_bdd;
    private $annee;
    private $driver;
    private $connection;

    private $doctrine_co_pile = array();
    private $pdo_co_pile = array();

    public function getDoctrinePile($co_key=null){
        $doctrine_co_pile = $this->doctrine_co_pile;
        if($co_key!=null){
            $doctrine_co_pile = isset($doctrine_co_pile[$co_key]) ? $doctrine_co_pile[$co_key] : null;
        }
        return $doctrine_co_pile;
    }
    public function addToDoctrinePile($co_key,$co){
        $this->doctrine_co_pile[$co_key]=$co;
    }
    public function getPdoPile($co_key=null){
        $pdo_co_pile = $this->pdo_co_pile;
        if($co_key!=null){
            $pdo_co_pile = isset($pdo_co_pile[$co_key]) ? $pdo_co_pile[$co_key] : null;
        }
        return $pdo_co_pile;
    }
    public function addToPdoPile($co_key,$co){
        $this->pdo_co_pile[$co_key]=$co;
    }

    /**
     * BsConsoPrecedentPreparator constructor.
     *
     * @param $em     EntityManager    The default EntityManager
     */
    public function __construct($em, $token_storage)
    {
        $this->em = $em;
        $this->driver = "pdo_mysql";
        $this->token_storage = $token_storage;
        $this->user = $token_storage->getToken()->getUser();

        if($this->user !== null){
            try{
                $this->collectivite = $this->user->getCollectivite();
            }catch(Exception $exception){
                $session = $this->get('session');
                $this->idColl = $session->get('coll_id');
            }

        }
    }

    /*
     * Methode permettant de retourner le tableau du fichier de configuration
     */
    public function getJsonConfigfile(){
        $json = file_get_contents(  $this->config_base_path.$this->jsonFile);
        //Decode JSON
        $array = json_decode($json,true);
        return $array;
    }

    public function prepareBddConnection($annee){
        // Read JSON file
        $this->annee = $annee;
        $json_data = $this->getJsonConfigfile();

        $config = null;
        //dump($json_data[$this->annee]);
        if(isset($json_data[$this->annee])){
            $this->password_bdd = $json_data[$this->annee]['bdd_mdp'];
            $this->user_bdd = $json_data[$this->annee]['bdd_user'];
            $this->name_bdd = $json_data[$this->annee]['bdd_name'];
            $this->port_bdd = isset($json_data[$this->annee]['bdd_port']) && $json_data[$this->annee]['bdd_port']!=null ? $json_data[$this->annee]['bdd_port'] : 3306 ;
            $this->host_bdd = $json_data[$this->annee]['bdd_host'];
            $this->indicateur = isset($json_data[$this->annee]['indicateur']) ? $json_data[$this->annee]['indicateur'] : null;

            $config = array(
                'driver'   => $this->driver,
                'user'     => $this->user_bdd,
                'password' => $this->password_bdd,
                'dbname'   => $this->name_bdd,
                'host' => $this->host_bdd,
                'port' => $this->port_bdd,
            );
        }

        return $config;
    }
    public function getDoctrineConnection($annee,$options=array()){
        extract($options);
        $force_new = isset($force_new) && $force_new == true ? true : false;
        $connection=null;
        if(($connection=$this->getDoctrinePile($annee))==null || $force_new==true){
            $conn = $this->prepareBddConnection($annee);
            $connection = \Doctrine\ORM\EntityManager::create(
                $conn,
                $this->em->getConfiguration(),
                $this->em->getEventManager()
            );
            $this->addToDoctrinePile($annee,$connection);
        }
       
        return $connection;
    }
    public function getPdoConnection($annee,$options=array()){
        extract($options);
        $force_new = isset($force_new) && $force_new == true ? true : false;
        $connection=null;
        $conn = $this->prepareBddConnection($annee);
        if(isset($conn)){
            if($this->getPdoPile($annee)==null || $force_new==true){
                try {
                    $conn = new PDO("mysql:host=".$conn['host'].";port=".$conn['port'].";"."charset=UTF8;dbname=".$conn['dbname'], $conn['user'], $conn['password'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    $this->connection = $conn;
                    $this->addToPdoPile($annee,$conn);
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    $conn = null;
                }
            }else{
                $conn = $this->getPdoPile($annee);
            }
        }

        return isset($conn) ? $conn : null ;
    }
    public function getSqlBatchsDoctrineConnection($annee){
        $co_config_key = 'batchs_'.$annee;
        return $this->getDoctrineConnection($co_config_key);
    }
    public function getSqlBatchsPdoConnection($annee){
        $co_config_key = 'batchs_'.$annee;
        return $this->getPdoConnection($co_config_key);
    }
    public function getSqlBsltmDoctrineConnection($annee){
        $co_config_key = 'bsltm_'.$annee;
        return $this->getDoctrineConnection($co_config_key);
    }
    public function getSqlBsltmPdoConnection($annee){
        $co_config_key = 'bsltm_'.$annee;
        return $this->getPdoConnection($co_config_key);
    }

}