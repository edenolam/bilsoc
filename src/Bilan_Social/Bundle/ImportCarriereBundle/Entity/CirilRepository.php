<?php
namespace Bilan_Social\Bundle\ImportCarriereBundle\Entity;

use Doctrine\ORM\EntityRepository;

Class CirilRepository Extends EntityRepository{
	
	/*
    *
    */
    public function getDataToImport(){
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql_agent = "SELECT * FROM ciril_agent c_agent 
            JOIN ciril_collectivite c_coll 
                ON c_coll.identifiant_collectivite=c_agent.identifiant_collectivite 
            WHERE c_coll.can_import = 1";
            
        //var_dump($sql_agent);
        //var_dump($conn);
        $stmt_agent = $conn->query($sql_agent);
        $stmt_agent = $conn->prepare($sql_agent);
        $stmt_agent->execute();
        $agents = $stmt_agent->fetchAll();
//        while ($row = $stmt_agent->fetch()) {
//            //var_dump($row);
//        }
        //var_dump($agents);
        foreach ($agents as $key => $agent){

            $id_agent = $agent['identifiant_agent'];
            $sql_form_agent ="SELECT * FROM ciril_formation c_form WHERE c_form.identifiant_agent=".$id_agent.";";
            //var_dump($sql_form_agent);
            $stmt_form_agent = $conn->prepare($sql_form_agent);
            $stmt_form_agent->execute();
            $formations_agent = $stmt_form_agent->fetchAll();
            $agent['formations']=$formations_agent;
        }
        
        return $agents;
    }
}

?>