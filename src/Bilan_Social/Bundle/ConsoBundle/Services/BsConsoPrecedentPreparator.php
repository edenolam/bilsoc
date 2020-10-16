<?php

namespace Bilan_Social\Bundle\ConsoBundle\Services;


use Symfony\Component\Config\Definition\Exception\Exception;
use PDO;

/**
 * Service BsConsoPrecedentPreparator
 *
 */
class BsConsoPrecedentPreparator
{
    private $config_base_path = __DIR__.'/../Resources/config/bsPrecedentConfig/';
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
    private $idColl;
    private $connection;


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

    /* Methode permetant de retourner l indicateur donné dans le fichier de configuration */

    public function getJsonIndicateurConfig($indicateur, $annee){
        $json = file_get_contents(  $this->config_base_path.$this->jsonFile);
        //Decode JSON
        $array_config =  json_decode($json,true);
        $array_ind = $array_config[$this->annee]['indicateur'];
        $exist = array_key_exists ($indicateur, $array_ind);
        if($exist){
            return $array_ind[$indicateur];
        }else{
            return null;
        }

    }
    public function prepareBddConnection($annee){
        // Read JSON file
        $this->annee = $annee;
        $json_data = $this->getJsonConfigfile();

        $config = null;
        if(isset($json_data[$this->annee])){
            $this->password_bdd = $json_data[$this->annee]['bdd_mdp'];
            $this->user_bdd = $json_data[$this->annee]['bdd_user'];
            $this->name_bdd = $json_data[$this->annee]['bdd_name'];
            $this->port_bdd = $json_data[$this->annee]['bdd_port'];
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
    public function getDoctrineConnection($annee){
        $conn = $this->prepareBddConnection($annee);

        $this->connection = \Doctrine\ORM\EntityManager::create(
            $conn,
            $this->em->getConfiguration(),
            $this->em->getEventManager()
        );


        return $this->connection;
    }
    public function getPdoConnection($annee){

        $conn = $this->prepareBddConnection($annee);
        if(isset($conn)){

            try {
                $conn = new PDO("mysql:host=".$conn['host'].";"."port=".$conn['port'].";"."dbname=".$conn['dbname'], $conn['user'], $conn['password'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $this->connection = $conn;
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                $conn = null;
            }
        }else{

        }

        return isset($conn) ? $conn : null ;
    }
    public function getIdAncienBilanSocial($annee, $username){
        $connectionPdo = $this->getPdoConnection($annee);
        $bilan_social = null;
        if(isset($connectionPdo)){
            try{
                $stmt = $connectionPdo->prepare(
                    'SELECT bsc.ID_BILASOCICONS
                          FROM utilisateur u
                          JOIN bilan_social_consolide bsc ON bsc.ID_COLL  = u.ID_COLL
                          WHERE u.USERNAME = :Username;'
                );
                $stmt->bindParam(':Username',$username, PDO::PARAM_STR);
                $stmt->execute();
                $bilan_social = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->annee = $annee;
            }catch(\Exception $e){
                return $e->getMessage();
            }
        }
        return !empty($bilan_social) ? $bilan_social['ID_BILASOCICONS'] : null;

    }
    public function getFirstPastIdBilanSocial($startDate,$username){
        $annee_minus = $startDate-1;
        $id_bilan = null;
        if(array_key_exists($startDate, $this->getJsonConfigfile())){
            $id_bilan = $this->getIdAncienBilanSocial($startDate, $username);
            if($id_bilan===null){
                $id_bilan = $this->getFirstPastIdBilanSocial($annee_minus,$username);
            }
        }
        return $id_bilan;

    }
    public function getIndPrecedent($annee, $username, $indKey, $bilanSocialConsoActuel){

        $idAncienBilanSocial = $this->getFirstPastIdBilanSocial($annee,$username);
        $strOrder = null;

        $array_ind_template = null;
        $extra_var = array();
        if(isset($idAncienBilanSocial)){

            $indConfig = $this->getJsonIndicateurConfig($indKey, $annee);


            if(isset($indConfig)){
                $strOrder = $this->getOrder($indConfig,$bilanSocialConsoActuel);



                $query = $this->preparBddQueryInd($indConfig,$idAncienBilanSocial,$strOrder);

                    $connectionPdo = $this->connection;
                    if(isset($query) && isset($connectionPdo)){
                        
                        $stmt = $connectionPdo->prepare($query);
                        $stmt->execute();
                        $ind = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $array_ind_template = [
                            "indicateur" => $ind,
                            "annee" => $this->annee,
                            "extra_var" => array()
                        ];

                        if(isset($indConfig['extra_var'])){

                            foreach ($indConfig['extra_var'] as $key => $value){
                                $query_extra_var = $this->preparBddQueryInd($value,$idAncienBilanSocial,null);

                                $stmt = $connectionPdo->prepare($query_extra_var);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                array_push($array_ind_template['extra_var'], $result[0]);
                            }
                        }
                    }
            }
        }
        return $array_ind_template !== null && !empty($array_ind_template) ? $array_ind_template : null;
    }
    public function getOrder($indConfig, $bilanSocialConsoActuel){

        // dump($bilanSocialConsoActuel); exit();

        if($indConfig){

            $collections = null;
            $orderField = null;
            $refMethod = null;
            $refMethodCode = null;

            $array_str_order_id = [];
            if(isset($indConfig['order'])){
                $refMethod = $indConfig['order']['refMethod'];
                $orderField = $indConfig['order']['orderField'];
                $refMethodCode = $indConfig['order']['refMethodCode'];
            }
            if(isset($refMethod)){
                if(method_exists($bilanSocialConsoActuel, $indConfig['method'])){
                    $strMethod = $indConfig['method'];
                    $collections = $bilanSocialConsoActuel->$strMethod();
                    foreach ($collections as $key => $value){
                        array_push($array_str_order_id, '"' . $value->$refMethod()->$refMethodCode().'"');
                    }
                    
                    $str_cd = implode(',',$array_str_order_id);

                }
            }
        }

        return isset($str_cd) ? $str_cd : null ;
    }
    public function preparBddQueryInd($indConfig,$idAncienBilanSocial,$strOrder = null){

        if(isset($indConfig) && isset($idAncienBilanSocial)){
            /* Creation de la query pour ensuite recuperer sous forme de tableau l indicateur souhaité */
            if(isset($indConfig['field'])){
                $query = 'SELECT ' . $indConfig['field'];
            }else{
                $query = 'SELECT * ';
            }

            $query .= ' FROM '. $indConfig['table'] .' ind';
            if(isset($indConfig['order'])){
                $query .= ' JOIN ' .$indConfig['order']["tableRef"] . ' ref ON ind.'.$indConfig['order']["joinKey"].' = ref.'.$indConfig['order']["joinKey"];
            }
            if(isset($indConfig['subRef'])) {
                $query .= ' JOIN ' .$indConfig['subRef']['tableRef'] . ' ref2 ON ref.'.$indConfig['order']['subRefJoinKey'].' = ref2.'.$indConfig['subRef']['joinKey']; 
            }
            $query .= ' WHERE ind.ID_BILASOCICONS = ' .$idAncienBilanSocial;
            if($strOrder !== null){
                $query .= ' AND ref.'.$indConfig['order']['orderField'] . ' IN('.$strOrder.') 
                      ORDER BY FIELD(ref.'.$indConfig['order']['orderField'].','.$strOrder.')';
            }
            $query .= ';';
        }
        return isset($query) ? $query : null ;
    }

}