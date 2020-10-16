<?php

namespace Bilan_Social\Bundle\ConsoBundle\Services;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Doctrine\Common\Collections\ArrayCollection;
use Bilan_Social\Bundle\ConsoBundle\Entity as IndEntity;

/**
 * Service BsConsoIndPreparator
 *
 */
class BsConsoIndPreparator
{
    CONST ON_MOVE_SET_IND_FIELD = 'set_ind_field';
    CONST ON_MOVE_CUSTOM_FUNCTION = 'custom_function';
    CONST ON_EVENT_CUSTOM_FUNCTION = 'on_event_custom_function';
    CONST REF_TYPE_DATABASE = 'ref_type_database';
    CONST REF_TYPE_MANUAL = 'ref_type_manual';

    CONST FROM_INDICATEUR_PROPERTY = 'from_indicateur_property';
    CONST FROM_CUSTOM_FUNCTION = 'from_custom_function';
    CONST FROM_BUILD_IN_FUNCTION = 'from_build_in_function';

    CONST CD_FILI_AOTM_HH = array('AOTM',' H','H','HH');

	private $em;
	private $bs;
	private $token_storage;
	private $user;
    private $temp_ind_container;
    private $indConfig;
    private $build_in_function_dealer;

    /**
     * BsConsoIndPreparator constructor.
     *
     * @param $em     EntityManager    The default EntityManager
     */
    public function __construct($em, $token_storage)
    {
        $this->em = $em;
        $this->token_storage = $token_storage;
        $this->user = $token_storage->getToken()->getUser();
        $this->resetTempIndContainer();

        $this->indConfig = array(
            // Effectif
            'Ind1101'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiFonctionnel',
                    'ind_key'=>'refEmploiFonctionnel'
                ),
                'entity_key'=>'ind1101s',
                'instance_of'=>'Ind1101',
            ),
            'Ind1102'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiFonctionnel',
                    'ind_key'=>'refEmploiFonctionnel'
                ),
                'entity_key'=>'ind1102s',
                'instance_of'=>'Ind1102',
            ),
            'Ind1103'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiFonctionnel',
                    'ind_key'=>'refEmploiFonctionnel'
                ),
                'entity_key'=>'ind1103s',
                'instance_of'=>'Ind1103',
            ),
            'Ind111'=>array(
                'refs'=>array(
                    'ref_name'=>'RefGrade',
                    'ind_key'=>'refGrade',
                    'exclude'=>array(
                        'join'=>array(
                            'current_repo.refCadreEmploi'=>'rce',
                            'rce.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                ),
                'entity_key'=>'ind111s',
                'instance_of'=>'Ind111',
                'print_for'=>array(
                    'refGrade',
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCadrempl',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'idCadrempl'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbCadrempl',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'lbCadrempl'
                        )
                    ),/*array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>function($ind_name,$ind_data){
                                $total = $ind_data->getR1115() + $ind_data->getR1116();
                                return $total;
                            }
                        )
                    ),*/array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_fili = $ind_data->getIdFili();
                            $current_id_cadre_emploi = $ind_data->getIdCadrempl();
                            if($pre_ind!=null){
                                $pre_id_fili = $pre_ind->getIdFili();
                                $pre_id_cadre_emploi = $pre_ind->getIdCadrempl();

                                if($pre_id_fili!=$current_id_fili){
                                    $ind_data->setNewFiliere(true);
                                }
                                if($pre_id_cadre_emploi!=$current_id_cadre_emploi){
                                    $ind_data->setNewCadreEmploi(true);
                                }
                            }else{
                                $ind_data->setNewFiliere(true);
                                $ind_data->setNewCadreEmploi(true);
                            }
                            if($next_ind!=null){
                                $next_id_fili = $next_ind->getRefGrade()->getRefCadreEmploi()->getRefFiliere()->getIdFili();
                                $next_id_cadre_emploi = $next_ind->getRefGrade()->getRefCadreEmploi()->getIdCadrempl();
                                if($next_id_fili!=$current_id_fili){
                                    $ind_data->setLastFiliere(true);
                                }
                                if($next_id_cadre_emploi!=$current_id_cadre_emploi){
                                    $ind_data->setLastCadreEmploi(true);
                                }
                            }else{
                                $ind_data->setLastFiliere(true);
                                $ind_data->setLastCadreEmploi(true);
                            }
                        }
                    )
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'idCadrempl'
                        )
                    )
                )
            ),
            'Ind111AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefGrade',
                    'ind_key'=>'refGrade',
                    'exclusive'=>array(
                        'join'=>array(
                            'current_repo.refCadreEmploi'=>'rce',
                            'rce.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind111s',
                'temp_key'=>'ind111AotmsTemp',
                'instance_of'=>'Ind111',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCadrempl',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'idCadrempl'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbCadrempl',
                        'value_from'=>array(
                            'refGrade',
                            'refCadreEmploi',
                            'lbCadrempl'
                        )
                    )
                )
            ),
            'Ind112'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclude'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                ),
                'entity_key'=>'ind112s',
                'instance_of'=>'Ind112',
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    ),/*array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>function($ind_data,$ind_name){
                                $total = $ind_data->getR1121() + $ind_data->getR1122() + $ind_data->getR1123() + $ind_data->getR1124() + $ind_data->getR1125() + $ind_data->getR1126() + $ind_data->getR1127()  + $ind_data->getR1128();
                                return $total;
                            }
                        )
                    ),*/array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_fili = $ind_data->getIdFili();
                            if($pre_ind!=null){
                                $pre_id_fili = $pre_ind->getIdFili();
                                if($pre_id_fili!=$current_id_fili){
                                    $ind_data->setNewFiliere(true);
                                }
                            }else{
                                $ind_data->setNewFiliere(true);
                            }
                            if($next_ind!=null){
                                $next_id_fili = $next_ind->getRefCadreEmploi()->getRefFiliere()->getIdFili();
                                if($next_id_fili!=$current_id_fili){
                                    $ind_data->setLastFiliere(true);
                                }
                            }else{
                                $ind_data->setLastFiliere(true);
                            }
                            $totalCeInd111=0;
                            foreach ($this->getBs()->getInd111s() as $ind111) {
                                if ($ind111->getR1111() == null) {
                                    continue;
                                }
                                if ($ind111->getRefGrade()->getRefCadreEmploi()->getIdCadrempl() == $ind_data->getRefCadreEmploi()->getIdCadrempl()) {
                                    $totalCeInd111 = $totalCeInd111 + $ind111->getR1111();
                                }
                            }
                            $ind_data->setTotalCeInd111($totalCeInd111);
                        }
                    )
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind112AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclusive'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind112s',
                'temp_key'=>'ind112AotmsTemp',
                'instance_of'=>'Ind112',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCadrempl',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'idCadrempl'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $totalCeInd111=0;
                            foreach ($this->getBs()->getInd111s() as $ind111) {
                                if ($ind111->getR1111() == null) {
                                    continue;
                                }
                                if ($ind111->getRefGrade()->getRefCadreEmploi()->getIdCadrempl() == $ind_data->getRefCadreEmploi()->getIdCadrempl()) {
                                    $totalCeInd111 = $totalCeInd111 + $ind111->getR1111();
                                }
                            }
                            $ind_data->setTotalCeInd111($totalCeInd111);
                        }
                    )
                )
            ),
            'Ind113'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                    ),array(
                        'ref_type'=>self::REF_TYPE_MANUAL,
                        'ind_key'=>'fgGenr',
                        'ref_data'=>array('H','F'),
                        'ref_name'=>'genre',
                    )
                ),
                'entity_key'=>'ind113s',
                'temp_key'=>'ind113s',
                'instance_of'=>'Ind113',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind114'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefFiliere',
                        'ind_key'=>'refFiliere',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    ),
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind114s',
                'instance_of'=>'Ind114',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $totalCeInd111=0;
                            foreach ($this->getBs()->getInd111s() as $ind111) {
                                if ($ind111->getR1111() === null) {
                                    continue;
                                }
                                if ($ind111->getRefGrade()->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $ind_data->getRefFiliere()->getIdFili()) {
                                    $totalCeInd111 = $totalCeInd111 + $ind111->getR1115() + $ind111->getR1116();
                                }
                            }
                            $ind_data->setTotalFilInd111($totalCeInd111);
                        }
                    )
                )
            ),
            'Ind114AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefFiliere',
                    'ind_key'=>'refFiliere',
                    'exclusive'=>array(
                        'fields'=>'current_repo.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind114s',
                'temp_key'=>'ind114AotmsTemp',
                'instance_of'=>'Ind114',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $totalCeInd111=0;
                            foreach ($this->getBs()->getInd111s() as $ind111) {
                                if ($ind111->getR1111() == null) {
                                    continue;
                                }
                                if ($ind111->getRefGrade()->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $ind_data->getRefFiliere()->getIdFili()) {
                                    $totalCeInd111 = $totalCeInd111 + $ind111->getR1115() + $ind111->getR1116();
                                }
                            }
                            $ind_data->setTotalFilInd111($totalCeInd111);
                        }
                    )
                )
            ),
            'Ind121'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclude'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                ),
                'entity_key'=>'ind121s',
                'instance_of'=>'Ind121',
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),/*array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R1211','R1212','R1213','R1214','R1215','R1216','R1217','R1218')
                                )
                            )
                        )
                    ),*/array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_fili = $ind_data->getIdFili();
                            if($pre_ind!=null){
                                $pre_id_fili = $pre_ind->getIdFili();
                                if($pre_id_fili!=$current_id_fili){
                                    $ind_data->setNewFiliere(true);
                                }
                            }else{
                                $ind_data->setNewFiliere(true);
                            }
                            if($next_ind!=null){
                                $next_id_fili = $next_ind->getRefCadreEmploi()->getRefFiliere()->getIdFili();
                                if($next_id_fili!=$current_id_fili){
                                    $ind_data->setLastFiliere(true);
                                }
                            }else{
                                $ind_data->setLastFiliere(true);
                            }
                        }
                    )
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind121AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclusive'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind121s',
                'temp_key'=>'ind121AotmsTemp',
                'instance_of'=>'Ind121',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),/*array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R1211','R1212','R1213','R1214','R1215','R1216','R1217','R1218')
                                )
                            )
                        )
                    )*/
                )
            ),
            'Ind122'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclude'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                ),
                'entity_key'=>'ind122s',
                'instance_of'=>'Ind122',
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    ),/*array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R1221','R1222','R1223','R1224','R1225','R1226','R1227','R1228')
                                )
                            )
                        )
                    ),*/array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_fili = $ind_data->getIdFili();
                            if($pre_ind!=null){
                                $pre_id_fili = $pre_ind->getIdFili();
                                if($pre_id_fili!=$current_id_fili){
                                    $ind_data->setNewFiliere(true);
                                }
                            }else{
                                $ind_data->setNewFiliere(true);
                            }
                            if($next_ind!=null){
                                $next_id_fili = $next_ind->getRefCadreEmploi()->getRefFiliere()->getIdFili();
                                if($next_id_fili!=$current_id_fili){
                                    $ind_data->setLastFiliere(true);
                                }
                            }else{
                                $ind_data->setLastFiliere(true);
                            }
                            $totalInd121=0;
                            foreach ($this->getBs()->getInd121s() as $ind121) {

                                if ($ind121->getRefCadreEmploi()->getIdCadrempl() == $ind_data->getRefCadreEmploi()->getIdCadrempl()) {
                                    $totalInd121 = $totalInd121 + $ind121->getR1219(0);
                                }
                            }
                            $ind_data->setTotalInd121($totalInd121);
                        }
                    )
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind122AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclusive'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind122s',
                'temp_key'=>'ind122AotmsTemp',
                'instance_of'=>'Ind122',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'idFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'cdFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'cdFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbFili',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refFiliere',
                            'lbFili'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    ),/*array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R1221','R1222','R1223','R1224','R1225','R1226','R1227','R1228')
                                )
                            )
                        )
                    ),*/array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $totalInd121=0;
                            foreach ($this->getBs()->getInd121s() as $ind121) {
                                if ($ind121->getR1219() == null) {
                                    continue;
                                }
                                if ($ind121->getRefCadreEmploi()->getIdCadrempl() == $ind_data->getRefCadreEmploi()->getIdCadrempl()) {
                                    $totalInd121 = $totalInd121 + $ind121->getR1219();
                                }
                            }
                            $ind_data->setTotalInd121($totalInd121);
                        }
                    )
                )
            ),
            'Ind123'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                    ),array(
                        'ref_type'=>self::REF_TYPE_MANUAL,
                        'ind_key'=>'fgGenr',
                        'ref_data'=>array('H','F'),
                        'ref_name'=>'genre',
                    )
                ),
                'entity_key'=>'ind123s',
                'temp_key'=>'ind123s',
                'instance_of'=>'Ind123',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $totalInd122=0;
                            foreach ($this->getBs()->getInd122s() as $ind122) {
                                if ($ind122->getRefCadreEmploi()->getRefCategorie()->getIdCate() == $ind_data->getRefCategorie()->getIdCate()) {
                                    $totalInd122 += $ind122->getR1223(0) + $ind122->getR1224(0) + $ind122->getR1225(0) + $ind122->getR1226(0) + $ind122->getR1227(0) + $ind122->getR1228(0);
                                }
                            }
                            $ind_data->setTotalInd122($totalInd122);
                        }
                    )
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind124'=>array(
                'refs'=>array(
                    array(
                    'ref_name'=>'RefFiliere',
                    'ind_key'=>'refFiliere',
                    'exclude'=>array(
                        'fields'=>'current_repo.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                    ),
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind124s',
                'instance_of'=>'Ind124',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $totalFilInd121=0;
                            foreach ($this->getBs()->getInd121s() as $ind121) {
                                if ($ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $ind_data->getRefFiliere()->getIdFili()) {
                                    $totalFilInd121 = $totalFilInd121 + $ind121->getR1211(0) +  $ind121->getR1212(0)
                            +  $ind121->getR1213(0)+  $ind121->getR1214(0)+  $ind121->getR1215(0)+  $ind121->getR1216(0)+  $ind121->getR1217(0)
                            +  $ind121->getR1218(0)+  $ind121->getR12118(0);
                                }
                            }
                            $ind_data->setTotalFilInd121($totalFilInd121);
                        }
                    )
                )
            ),
            'Ind124AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefFiliere',
                    'ind_key'=>'refFiliere',
                    'exclusive'=>array(
                        'fields'=>'current_repo.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind124s',
                'temp_key'=>'ind124AotmsTemp',
                'instance_of'=>'Ind124',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $totalFilInd121=0;
                            foreach ($this->getBs()->getInd121s() as $ind121) {
                                if ($ind121->getRefCadreEmploi()->getRefFiliere()->getIdFili() == $ind_data->getRefFiliere()->getIdFili()) {
                                    $totalFilInd121 = $totalFilInd121 + $ind121->getR1211(0) +  $ind121->getR1212(0)
                            +  $ind121->getR1213(0)+  $ind121->getR1214(0)+  $ind121->getR1215(0)+  $ind121->getR1216(0)+  $ind121->getR1217(0)
                            +  $ind121->getR1218(0)+  $ind121->getR12118(0);
                                }
                            }
                            $ind_data->setTotalFilInd121($totalFilInd121);
                        }
                    )
                )
            ),
            'Ind1311'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiNonPermanent',
                    'ind_key'=>'refEmploiNonPermanent'
                ),
                'entity_key'=>'ind1311s',
                'instance_of'=>'Ind1311',
            ),
            'Ind1312'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiNonPermanent',
                    'ind_key'=>'refEmploiNonPermanent'
                ),
                'entity_key'=>'ind1312s',
                'instance_of'=>'Ind1312',
            ),
            'Ind132'=>array(
                'refs'=>array(
                    'ref_name'=>'RefFiliere',
                    'ind_key'=>'refFiliere',
                    'exclude'=>array(
                        'fields'=>'current_repo.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                ),
                'entity_key'=>'ind132s',
                'instance_of'=>'Ind132',
                'temp_key'=>'ind132s'
            ),
            'Ind132Bis'=>array(
                'entity_key'=>'ind132Biss',
                'instance_of'=>'Ind132Bis',
                'temp_key'=>'ind132Biss'
            ),
            'Ind141'=>array(
                'refs'=>array(
                    'ref_name'=>'RefPositionStatutaire',
                    'ind_key'=>'refPositionStatutaire',
                    /*'exclude'=>array(
                        'fields'=>array('current_repo.refGroupePositionStatutaire'),
                        'values'=>array(null)
                    ),*/
                    'include'=>array(
                        'fields'=>array('current_repo.blInd142','current_repo.blInd143','current_repo.blInd144'),
                        'values'=>array(array(0,null),array(0,null),array(0,null))
                    ),
                    
                ),
                'extra_dependency_options'=>array(
                    'refGroupePositionStatutaire'=>array(
                        'for_ref'=>'refGroupePositionStatutaire',
                        'join_function'=>'leftJoin',
                        'is_nullable'=>true
                        //'on_expr'=>'current_repo.refGroupePositionStatutaire IS NULL',
                        //'group_by'=>'current_repo.idPosistat'
                    )
                ),
                'entity_key'=>'ind141s',
                'instance_of'=>'Ind141',
                'temp_key'=>'ind141s',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'idGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouCompl',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouCompl'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouComm',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouComm'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_group = $ind_data->getIdGrouPosistat();
                            if($pre_ind!=null){
                                $pre_id_group = $pre_ind->getIdGrouPosistat();
                                if($pre_id_group!=$current_id_group){
                                    $ind_data->setNewGroupe(true);
                                }
                            }else{
                                $ind_data->setNewGroupe(true);
                            }
                            if($next_ind!=null){
                                if($next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()!=null){
                                    $next_id_group = $next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()->getIdGrouPosistat();
                                    if($next_id_group!=$current_id_group){
                                        $ind_data->setLastGroupe(true);
                                    }
                                }else{
                                    $ind_data->setLastGroupe(true);
                                }

                            }else{
                                $ind_data->setLastGroupe(true);
                            }
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'idGrouPosistat'
                        ),
                        'value_to_seek'=>array(
                            null
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'idGrouPosistat'
                        ),
                        'value_to_seek'=>array(
                            7,8,9
                        )
                    ),
                )
            ),
            'Ind142'=>array(
                'refs'=>array(
                    'ref_name'=>'RefPositionStatutaire',
                    'ind_key'=>'refPositionStatutaire',
                    'exclusive'=>array(
                        'fields'=>array('current_repo.blInd142'),
                        'values'=>array(1)
                    )
                ),
                'entity_key'=>'ind142s',
                'instance_of'=>'Ind142',
                'temp_key'=>'ind142s',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'idGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouCompl',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouCompl'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouComm',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouComm'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_group = $ind_data->getIdGrouPosistat();
                            if($pre_ind!=null){
                                $pre_id_group = $pre_ind->getIdGrouPosistat();
                                if($pre_id_group!=$current_id_group){
                                    $ind_data->setNewGroupe(true);
                                }
                            }else{
                                $ind_data->setNewGroupe(true);
                            }
                            if($next_ind!=null){
                                if($next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()!=null){
                                    $next_id_group = $next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()->getIdGrouPosistat();
                                    if($next_id_group!=$current_id_group){
                                        $ind_data->setLastGroupe(true);
                                    }
                                }else{
                                    $ind_data->setLastGroupe(true);
                                }

                            }else{
                                $ind_data->setLastGroupe(true);
                            }
                        }
                    )
                )
            ),
            'Ind143'=>array(
                'refs'=>array(
                    'ref_name'=>'RefPositionStatutaire',
                    'ind_key'=>'refPositionStatutaire',
                    'exclusive'=>array(
                        'fields'=>array('current_repo.blInd143'),
                        'values'=>array(1)
                    )
                ),
                'entity_key'=>'ind143s',
                'instance_of'=>'Ind143',
                'temp_key'=>'ind143s',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'idGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouCompl',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouCompl'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouComm',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouComm'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_group = $ind_data->getIdGrouPosistat();
                            if($pre_ind!=null){
                                $pre_id_group = $pre_ind->getIdGrouPosistat();
                                if($pre_id_group!=$current_id_group){
                                    $ind_data->setNewGroupe(true);
                                }
                            }else{
                                $ind_data->setNewGroupe(true);
                            }
                            if($next_ind!=null){
                                if($next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()!=null){
                                    $next_id_group = $next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()->getIdGrouPosistat();
                                    if($next_id_group!=$current_id_group){
                                        $ind_data->setLastGroupe(true);
                                    }
                                }else{
                                    $ind_data->setLastGroupe(true);
                                }

                            }else{
                                $ind_data->setLastGroupe(true);
                            }
                        }
                    )
                )
            ),
            'Ind144'=>array(
                'refs'=>array(
                    'ref_name'=>'RefPositionStatutaire',
                    'ind_key'=>'refPositionStatutaire',
                    'exclusive'=>array(
                        'fields'=>array('current_repo.blInd144'),
                        'values'=>array(1)
                    )
                ),
                'entity_key'=>'ind144s',
                'instance_of'=>'Ind144',
                'temp_key'=>'ind144s',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'idGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouPosistat',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouPosistat'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouCompl',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouCompl'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'lbGrouComm',
                        'value_from'=>array(
                            'refPositionStatutaire',
                            'refGroupePositionStatutaire',
                            'lbGrouComm'
                        )
                    ),array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_group = $ind_data->getIdGrouPosistat();
                            if($pre_ind!=null){
                                $pre_id_group = $pre_ind->getIdGrouPosistat();
                                if($pre_id_group!=$current_id_group){
                                    $ind_data->setNewGroupe(true);
                                }
                            }else{
                                $ind_data->setNewGroupe(true);
                            }
                            if($next_ind!=null){
                                if($next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()!=null){
                                    $next_id_group = $next_ind->getRefPositionStatutaire()->getRefGroupePositionStatutaire()->getIdGrouPosistat();
                                    if($next_id_group!=$current_id_group){
                                        $ind_data->setLastGroupe(true);
                                    }
                                }else{
                                    $ind_data->setLastGroupe(true);
                                }

                            }else{
                                $ind_data->setLastGroupe(true);
                            }
                        }
                    )
                )
            ),
            /*
            *   Mouvement
            */
            'Ind1501'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifDepart',
                    'ind_key'=>'refMotifDepart',
                    'exclusive'=>array(
                        'fields'=>array('current_repo.cdMotidepa'),
                        'values'=>array('MD001', 'MD002', 'MD003','MD004','MD005', 'MD021', 'MD022', 'MD007','MD008', 'MD009', 'MD019','MD025','MD012', 'MD013','MD014', 'DCD', 'MD016', 'MD017')
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifDepart',
                            'blDepatemp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifDepart',
                            'blDepadefi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                ),
                'entity_key'=>'ind1501s',
                'instance_of'=>'Ind1501',
                'temp_key'=>'ind1501s',
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            $nbDefi = 0;
                            $nbTemp = 0;
                            $first_is_defi = false;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifDepart()->getBlDepadefi() == true) {
                                    if($temp_key==0) $first_is_defi = true;
                                    $nbDefi++;
                                }
                                else if($ind->getRefMotifDepart()->getBlDepatemp() == true) {
                                    if($temp_key==0) $first_is_defi = false;
                                    $nbTemp++;
                                }
                            }
                            $nb_first = $first_is_defi ? $nbDefi : $nbTemp;
                            $nb_second = $first_is_defi ? $nbTemp : $nbDefi;
                            $inds_temp[0]->setNbRowspan($nb_first);
                            $inds_temp[$nb_first]->setNbRowspan($nb_second);
                        }
                    )
                )
            ),
            'Ind1502'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifDepart',
                    'ind_key'=>'refMotifDepart',
                    'exclusive'=>array(
                        'fields'=>array('current_repo.cdMotidepa'),
                        'values'=>array('MD001', 'MD003','MD004','MD007', 'MD020','MD012', 'MD023', 'MD024', 'MD013','MD014', 'DCD','MD016','MD017', 'MD018')
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifDepart',
                            'blDepatemp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifDepart',
                            'blDepadefi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                ),
                'entity_key'=>'ind1502s',
                'instance_of'=>'Ind1502',
                'temp_key'=>'ind1502s',
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            $nbDefi = 0;
                            $nbTemp = 0;
                            $first_is_defi = false;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifDepart()->getBlDepadefi() == true) {
                                    if($temp_key==0) $first_is_defi = true;
                                    $nbDefi++;
                                }
                                else if($ind->getRefMotifDepart()->getBlDepatemp() == true) {
                                    if($temp_key==0) $first_is_defi = false;
                                    $nbTemp++;
                                }
                            }
                            $nb_first = $first_is_defi ? $nbDefi : $nbTemp;
                            $nb_second = $first_is_defi ? $nbTemp : $nbDefi;
                            $inds_temp[0]->setNbRowspan($nb_first);
                            $inds_temp[$nb_first]->setNbRowspan($nb_second);
                        }
                    )
                )
            ),
            'Ind1511'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefEmploiFonctionnel',
                        'ind_key'=>'refEmploiFonctionnel'
                    )
                ),
                'entity_key'=>'ind1511s',
                'instance_of'=>'Ind1511',
                'temp_key'=>'ind1511s',
            ),
            'Ind1512'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefEmploiFonctionnel',
                        'ind_key'=>'refEmploiFonctionnel'
                    )
                ),
                'entity_key'=>'ind1512s',
                'instance_of'=>'Ind1512',
                'temp_key'=>'ind1512s',
            ),
            'Ind1513'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefEmploiFonctionnel',
                        'ind_key'=>'refEmploiFonctionnel'
                    )
                ),
                'entity_key'=>'ind1513s',
                'instance_of'=>'Ind1513',
                'temp_key'=>'ind1513s',
            ),
            'Ind152'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclude'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                ),
                'entity_key'=>'ind152s',
                'instance_of'=>'Ind152',
                /*'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R1521','R1522','R1213','R1214','R1524','R1526','R1527',
                                        'R1528','R1529','R15210','R15211','R15212','R15213','R15214',
                                        'R15215','R15216','R15217','R15218'
                                    )
                                )
                            )
                        )
                    )
                ),*/
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind152AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclusive'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind152s',
                'temp_key'=>'ind152AotmsTemp',
                'instance_of'=>'Ind152',
                /*'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R1521','R1522','R1213','R1214','R1524','R1526','R1527',
                                        'R1528','R1529','R15210','R15211','R15212','R15213','R15214',
                                        'R15215','R15216','R15217','R15218'
                                    )
                                )
                            )
                        )
                    )
                )*/
            ),
            'Ind1531'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefMotifArrivee',
                        'ind_key'=>'refMotifArrivee',
                        'exclusive'=>array(
                            'fields'=>'current_repo.cdMotiarri',
                            'values'=> array('MA016', 'MA018', 'MA017'),
                        )
                    )
                ),
                'entity_key'=>'ind1531s',
                'instance_of'=>'Ind1531',
                'temp_key'=>'ind1531s'
            ),
            'Ind1532'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclude'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>self::CD_FILI_AOTM_HH,
                    )
                ),
                'entity_key'=>'ind1532s',
                'instance_of'=>'Ind1532',
                /*'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R15321','R15322','R15323','R15324')
                                )
                            )
                        )
                    )
                ),*/
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind1532AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi',
                    'exclusive'=>array(
                        'join'=>array(
                            'current_repo.refFiliere'=>'rf'
                        ),
                        'fields'=>'rf.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind1532s',
                'temp_key'=>'ind1532AotmsTemp',
                'instance_of'=>'Ind1532',
                /*'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R15321','R15322','R15323','R15324')
                                )
                            )
                        )
                    )
                )*/
            ),
            'Ind154'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefStageTitularisation',
                        'ind_key'=>'refStageTitularisation'
                    )
                ),
                'entity_key'=>'ind154s',
                'instance_of'=>'Ind154',
                'temp_key'=>'ind154s'
            ),
            'Ind155'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefAvancementPromotionConcours',
                        'ind_key'=>'refAvancementPromotionConcours'
                    )
                ),
                'entity_key'=>'ind155s',
                'instance_of'=>'Ind155',
                'temp_key'=>'ind155s'
            ),
            'Ind156'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie'
                    )
                ),
                'entity_key'=>'ind156s',
                'instance_of'=>'Ind156',
                'temp_key'=>'ind156s'
            ),
            'Ind157'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind157s',
                'instance_of'=>'Ind157',
                'temp_key'=>'ind157s'
            ),
            'Ind158'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefFiliere',
                        'ind_key'=>'refFiliere',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind158s',
                'instance_of'=>'Ind158',
            ),
            'Ind158AOTM'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefFiliere',
                        'ind_key'=>'refFiliere',
                        'exclusive'=>array(
                            'fields'=>'current_repo.cdFili',
                            'values'=>'AOTM',
                        )
                    )
                ),
                'entity_key'=>'ind158s',
                'temp_key'=>'ind158AotmsTemp',
                'instance_of'=>'Ind158',
            ),
            'Ind161'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                    )
                ),
                'entity_key'=>'ind161s',
                'temp_key'=>'ind161s',
                'instance_of'=>'Ind161',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind1612'=>array(
                'entity_key'=>'ind1612s',
                'temp_key'=>'ind1612s',
                'instance_of'=>'Ind1612'
            ),
            'Ind171'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefTrancheAge',
                        'ind_key'=>'refTrancheAge',
                    ),array(
                        'ref_type'=>self::REF_TYPE_MANUAL,
                        'ind_key'=>'fgGenr',
                        'ref_data'=>array('H','F'),
                        'ref_name'=>'genre',
                    )
                ),
                'entity_key'=>'ind171s',
                'temp_key'=>'ind171s',
                'instance_of'=>'Ind171',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'fgGenr'
                        )
                    )
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();


                            $next_ind = ($ind_temp_key+1)<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_genr = $ind_data->getFgGenr();

                            if($next_ind==null || $next_ind->getFgGenr()!=$current_genr){
                                $ind_data->setLastGenre(true);
                            }
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            $nbHomme = 0;
                            $nbFemme = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getFgGenr() == 'H') {
                                    $nbHomme++;
                                }
                                if($ind->getFgGenr() == 'F') {
                                    $nbFemme++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbHomme);
                            $inds_temp[$nbHomme]->setNbRowspan($nbFemme);
                        }
                    )
                )
            ),
            'Ind171E'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefTrancheAge',
                        'ind_key'=>'refTrancheAge',
                    ),array(
                        'ref_type'=>self::REF_TYPE_MANUAL,
                        'ind_key'=>'fgGenr',
                        'ref_data'=>array('E'),
                        'ref_name'=>'genre',
                    )
                ),
                'entity_key'=>'ind171s',
                'instance_of'=>'Ind171',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'fgGenr'
                        )
                    )
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();

                            $nb_in_temp = $temp_inds->count();
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_genr = $ind_data->getFgGenr();
                            if($next_ind==null || $next_ind->getFgGenr()!=$current_genr){
                                $ind_data->setLastGenre(true);
                            }
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            $nbEnsemble = 0;
                            $nbHommeFemme = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getFgGenr() == 'E') {
                                    $nbEnsemble++;
                                }else{
                                    $nbHommeFemme++;
                                }
                            }
                            $inds_temp[$nbHommeFemme]->setNbRowspan($nbEnsemble);
                        }
                    )
                )
            ),
            /*
            *   Absence et temps de travail
            */
            'Ind2111'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence'
                ),
                'entity_key'=>'ind2111s',
                'temp_key'=>'ind2111s',
                'instance_of'=>'Ind2111',
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            $nbAbsAutre = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }else if($ind->getRefMotifAbsence()->getBlAbseautrrais() == true) {
                                    $nbAbsAutre++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                            $inds_temp[$nbAbsComp + $nbAbsMedi]->setNbRowspan($nbAbsAutre);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbseautrrais'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2112'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence',
                    'exclude'=>array(
                        'fields'=>'current_repo.blAbseautrrais',
                        'values'=>'1',
                    )
                ),
                'entity_key'=>'ind2112s',
                'temp_key'=>'ind2112s',
                'instance_of'=>'Ind2112',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $total2111 = 0;
                            foreach ($this->getBs()->getInd2111s() as $ind2111) {
                                if ($ind2111->getRefMotifAbsence()->getIdMotiabse() == $ind_data->getRefMotifAbsence()->getIdMotiabse()) {
                                    $total2111 = $total2111 + $ind2111->getR21111(0) + $ind2111->getR21112(0);
                                }
                            }
                            $ind_data->setTotal2111($total2111);
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2113'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence',
                    'exclude'=>array(
                        'fields'=>'current_repo.blAbseautrrais',
                        'values'=>'1',
                    )
                ),
                'entity_key'=>'ind2113s',
                'temp_key'=>'ind2113s',
                'instance_of'=>'Ind2113',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $total2111 = 0;
                            foreach ($this->getBs()->getInd2111s() as $ind2111) {
                                if ($ind2111->getRefMotifAbsence()->getIdMotiabse() == $ind_data->getRefMotifAbsence()->getIdMotiabse()) {
                                    $total2111 = $total2111 + $ind2111->getR21113(0) + $ind2111->getR21114(0);
                                }
                            }
                            $ind_data->setTotal2111($total2111);
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2121'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence'
                ),
                'entity_key'=>'ind2121s',
                'temp_key'=>'ind2121s',
                'instance_of'=>'Ind2121',
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            $nbAbsAutre = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }else if($ind->getRefMotifAbsence()->getBlAbseautrrais() == true) {
                                    $nbAbsAutre++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                            $inds_temp[$nbAbsComp + $nbAbsMedi]->setNbRowspan($nbAbsAutre);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbseautrrais'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2122'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence',
                    'exclude'=>array(
                        'fields'=>'current_repo.blAbseautrrais',
                        'values'=>'1',
                    )
                ),
                'entity_key'=>'ind2122s',
                'temp_key'=>'ind2122s',
                'instance_of'=>'Ind2122',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $total2121 = 0;
                            foreach ($this->getBs()->getInd2121s() as $ind2121) {
                                if ($ind2121->getRefMotifAbsence()->getIdMotiabse() == $ind_data->getRefMotifAbsence()->getIdMotiabse()) {
                                    $total2121 = $total2121 + $ind2121->getR21211(0) + $ind2121->getR21212(0);
                                }
                            }
                            $ind_data->setTotal2121($total2121);
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2123'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence',
                    'exclude'=>array(
                        'fields'=>'current_repo.blAbseautrrais',
                        'values'=>'1',
                    )
                ),
                'entity_key'=>'ind2123s',
                'temp_key'=>'ind2123s',
                'instance_of'=>'Ind2123',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $total2121 = 0;
                            foreach ($this->getBs()->getInd2121s() as $ind2121) {
                                if ($ind2121->getRefMotifAbsence()->getIdMotiabse() == $ind_data->getRefMotifAbsence()->getIdMotiabse()) {
                                    $total2121 = $total2121 + $ind2121->getR21213(0) + $ind2121->getR21214(0);
                                }
                            }
                            $ind_data->setTotal2121($total2121);
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2131'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence'
                ),
                'entity_key'=>'ind2131s',
                'temp_key'=>'ind2131s',
                'instance_of'=>'Ind2131',

                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            $nbAbsAutre = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }else if($ind->getRefMotifAbsence()->getBlAbseautrrais() == true) {
                                    $nbAbsAutre++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                            $inds_temp[$nbAbsComp + $nbAbsMedi]->setNbRowspan($nbAbsAutre);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbseautrrais'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2132'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence',
                    'exclude'=>array(
                        'fields'=>'current_repo.blAbseautrrais',
                        'values'=>'1',
                    )
                ),
                'entity_key'=>'ind2132s',
                'temp_key'=>'ind2132s',
                'instance_of'=>'Ind2132',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $total2131 = 0;
                            foreach ($this->getBs()->getInd2131s() as $ind2131) {
                                if ($ind2131->getRefMotifAbsence()->getIdMotiabse() == $ind_data->getRefMotifAbsence()->getIdMotiabse()) {
                                    $total2131 = $total2131 + $ind2131->getR21311(0) + $ind2131->getR21312(0);
                                }
                            }
                            $ind_data->setTotal2131($total2131);
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind2133'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifAbsence',
                    'ind_key'=>'refMotifAbsence',
                    'exclude'=>array(
                        'fields'=>'current_repo.blAbseautrrais',
                        'values'=>'1',
                    )
                ),
                'entity_key'=>'ind2133s',
                'temp_key'=>'ind2133s',
                'instance_of'=>'Ind2133',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $total2131 = 0;
                            foreach ($this->getBs()->getInd2131s() as $ind2131) {
                                if ($ind2131->getRefMotifAbsence()->getIdMotiabse() == $ind_data->getRefMotifAbsence()->getIdMotiabse()) {
                                    $total2131 = $total2131 + $ind2131->getR21313(0) + $ind2131->getR21314(0);
                                }
                            }
                            $ind_data->setTotal2131($total2131);
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $inds_temp = $this->getTempIndContainer();
                            $nbAbsComp = 0;
                            $nbAbsMedi = 0;
                            foreach ($inds_temp as $temp_key => $ind) {
                                if($ind->getRefMotifAbsence()->getBlAbsecomp() == true) {
                                    $nbAbsComp++;
                                }else if($ind->getRefMotifAbsence()->getBlAbsemedi() == true) {
                                    $nbAbsMedi++;
                                }
                            }
                            $inds_temp[0]->setNbRowspan($nbAbsComp);
                            $inds_temp[$nbAbsComp]->setNbRowspan($nbAbsMedi);
                        }
                    )
                ),
                'make_group'=>array(
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsecomp'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    ),
                    array(
                        'value_from'=>array(
                            'refMotifAbsence',
                            'blAbsemedi'
                        ),
                        'value_to_seek'=>array(
                            true
                        )
                    )
                )
            ),
            'Ind214'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind214s',
                'temp_key'=>'ind214s',
                'instance_of'=>'Ind214',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind215'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind215s',
                'temp_key'=>'ind215s',
                'instance_of'=>'Ind215',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind216'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind216s',
                'temp_key'=>'ind216s',
                'instance_of'=>'Ind216',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind221'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCycleTravail',
                    'ind_key'=>'refCycleTravail'
                ),
                'entity_key'=>'ind221s',
                'temp_key'=>'ind221s',
                'instance_of'=>'Ind221',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_groupe_cyle_travail = $ind_data->getRefCycleTravail()->getLbGroupeCycltrav();
                            if($current_groupe_cyle_travail!=null || strtolower($current_groupe_cyle_travail)!='autre'){
                                if($pre_ind!=null){
                                    $pre_groupe_cyle_travail = $pre_ind->getRefCycleTravail()->getLbGroupeCycltrav();
                                    if($pre_groupe_cyle_travail!=$current_groupe_cyle_travail){
                                        $ind_data->setNewGroupe(true);
                                    }
                                }else{
                                    $ind_data->setNewGroupe(true);
                                }
                                if($next_ind!=null){
                                    $next_groupe_cyle_travail = $next_ind->getRefCycleTravail()->getLbGroupeCycltrav();
                                    if($next_groupe_cyle_travail!=$current_groupe_cyle_travail){
                                        $ind_data->setLastGroupe(true);
                                    }
                                }else{
                                    $ind_data->setLastGroupe(true);
                                }
                            }
                        }
                    )
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCycleTravail',
                            'lbGroupeCycltrav'
                        )
                    )
                )
            ),
            'Ind222'=>array(
                'refs'=>array(
                    'ref_name'=>'RefContrainteTravail',
                    'ind_key'=>'refContrainteTravail'
                ),
                'entity_key'=>'ind222s',
                'temp_key'=>'ind222s',
                'instance_of'=>'Ind222',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idConttrav',
                        'value_from'=>array(
                            'refContrainteTravail',
                            'idConttrav'
                        )
                    )
                )
            ),
            'Ind2231'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCategorie',
                    'ind_key'=>'refCategorie'
                ),
                'entity_key'=>'ind2231s',
                'temp_key'=>'ind2231s',
                'instance_of'=>'Ind2231',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind2232'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCategorie',
                    'ind_key'=>'refCategorie'
                ),
                'entity_key'=>'ind2232s',
                'temp_key'=>'ind2232s',
                'instance_of'=>'Ind2232',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind2233'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCategorie',
                    'ind_key'=>'refCategorie'
                ),
                'entity_key'=>'ind2233s',
                'temp_key'=>'ind2233s',
                'instance_of'=>'Ind2233',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idCate',
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind224'=>array(
                'entity_key'=>'ind224s',
                'temp_key'=>'ind224s',
                'instance_of'=>'Ind224'
            ),
            'Ind231'=>array(
                'refs'=>array(
                    'ref_type'=>self::REF_TYPE_MANUAL,
                    'ind_key'=>'cdDema',
                    'ref_data'=>array('DPR','DAC','PDS','MOQ','RTP'),
                    'ref_name'=>'codeDemande',
                ),
                'entity_key'=>'ind231s',
                'temp_key'=>'ind231s',
                'instance_of'=>'Ind231',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'order',
                        'value_from'=>array(
                            array(
                                'from_type'=>self::FROM_CUSTOM_FUNCTION,
                                'from_function'=>function($ind_name,&$ind_data){
                                    $demande_ref_config = $this->getIndRefByName($ind_name,'codeDemande');
                                    $cdDema = $this->getIndRefData($demande_ref_config,$ind_data);
                                    $demande_ref_data = $this->getRefValues($demande_ref_config);
                                    $order = array_search($cdDema,$demande_ref_data);
                                    if($order===false){
                                        $order = null;
                                    }
                                    return $order;
                                }
                            )
                        )
                    )
                )
            ),
            'Ind2261'=>array(
                'refs'=>array(
                    'ref_type'=>self::REF_TYPE_MANUAL,
                    'ind_key'=>'cdJourCarence',
                    'ref_data'=>array('NJCP','MBSRDC','NTARSJC','NAAJC','NAMSJC'),
                    'ref_name'=>'cdJourCarence',
                ),
                'entity_key'=>'ind2261s',
                'temp_key'=>'ind2261s',
                'instance_of'=>'Ind2261',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'order',
                        'value_from'=>array(
                            array(
                                'from_type'=>self::FROM_CUSTOM_FUNCTION,
                                'from_function'=>function($ind_name,&$ind_data){
                                    $cdJourCarence_ref_config = $this->getIndRefByName($ind_name,'cdJourCarence');
                                    $cdJourCarence= $this->getIndRefData($cdJourCarence_ref_config,$ind_data);
                                    $cdJourCarence_ref_data = $this->getRefValues($cdJourCarence_ref_config);
                                    $order = array_search($cdJourCarence,$cdJourCarence_ref_data);
                                    if($order===false){
                                        $order = null;
                                    }
                                    return $order;
                                }
                            )
                        )
                    )
                )
            ),
            'Ind2262'=>array(
                'refs'=>array(
                    'ref_type'=>self::REF_TYPE_MANUAL,
                    'ind_key'=>'cdJourCarence',
                    'ref_data'=>array('NJCP','MBSRDC','NTARSJC','NAAJC','NAMSJC'),
                    'ref_name'=>'cdJourCarence',
                ),
                'entity_key'=>'ind2262s',
                'temp_key'=>'ind2262s',
                'instance_of'=>'Ind2262',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'order',
                        'value_from'=>array(
                            array(
                                'from_type'=>self::FROM_CUSTOM_FUNCTION,
                                'from_function'=>function($ind_name,&$ind_data){
                                    $cdJourCarence_ref_config = $this->getIndRefByName($ind_name,'cdJourCarence');
                                    $cdJourCarence= $this->getIndRefData($cdJourCarence_ref_config,$ind_data);
                                    $cdJourCarence_ref_data = $this->getRefValues($cdJourCarence_ref_config);
                                    $order = array_search($cdJourCarence,$cdJourCarence_ref_data);
                                    if($order===false){
                                        $order = null;
                                    }
                                    return $order;
                                }
                            )
                        )
                    )
                )
            ),
            'Ind2263'=>array(
                'refs'=>array(
                    'ref_type'=>self::REF_TYPE_MANUAL,
                    'ind_key'=>'cdJourCarence',
                    'ref_data'=>array('NJCP','MBSRDC','NTARSJC','NAAJC','NAMSJC'),
                    'ref_name'=>'cdJourCarence',
                ),
                'entity_key'=>'ind2263s',
                'temp_key'=>'ind2263s',
                'instance_of'=>'Ind2263',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'order',
                        'value_from'=>array(
                            array(
                                'from_type'=>self::FROM_CUSTOM_FUNCTION,
                                'from_function'=>function($ind_name,&$ind_data){
                                    $cdJourCarence_ref_config = $this->getIndRefByName($ind_name,'cdJourCarence');
                                    $cdJourCarence= $this->getIndRefData($cdJourCarence_ref_config,$ind_data);
                                    $cdJourCarence_ref_data = $this->getRefValues($cdJourCarence_ref_config);
                                    $order = array_search($cdJourCarence,$cdJourCarence_ref_data);
                                    if($order===false){
                                        $order = null;
                                    }
                                    return $order;
                                }
                            )
                        )
                    )
                )
            ),
            /*
            *   Rémunération
            */
            'Ind311'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefFiliere',
                        'ind_key'=>'refFiliere',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    ),
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind311s',
                'instance_of'=>'Ind311',
            ),
            'Ind311AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefFiliere',
                    'ind_key'=>'refFiliere',
                    'exclusive'=>array(
                        'fields'=>'current_repo.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind311s',
                'temp_key'=>'ind311AotmsTemp',
                'instance_of'=>'Ind311',
            ),
            'Ind321'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefFiliere',
                        'ind_key'=>'refFiliere',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    ),
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind321s',
                //'temp_key'=>'ind321s',
                'instance_of'=>'Ind321'
            ),
            'Ind321AOTM'=>array(
                'refs'=>array(
                    'ref_name'=>'RefFiliere',
                    'ind_key'=>'refFiliere',
                    'exclusive'=>array(
                        'fields'=>'current_repo.cdFili',
                        'values'=>'AOTM',
                    )
                ),
                'entity_key'=>'ind321s',
                'temp_key'=>'ind321AotmsTemp',
                'instance_of'=>'Ind321',
            ),
            'Ind331'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiNonPermanent',
                    'ind_key'=>'refEmploiNonPermanent',
                    'exclusive'=>array(
                        'fields'=>'current_repo.cdEmplnonperm',
                        'values'=> array('EF002', 'EF003', 'EF999'),
                    )
                ),
                'entity_key'=>'ind331s',
                'temp_key'=>'ind331s',
                'instance_of'=>'Ind331'
            ),
            'Ind344'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclude'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind344s',
                'instance_of'=>'Ind344',
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
            ),
            'Ind344AOTM'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclusive'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>'AOTM',
                        )
                    )
                ),
                'entity_key'=>'ind344s',
                'temp_key'=>'ind344AotmsTemp',
                'instance_of'=>'Ind344',
                /*'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R3441','R3442','R3443','R3444')
                                )
                            )
                        )
                    )
                )*/
            ),
            /*
            *   Conditions
            */
            'Ind411'=>array(
                'refs'=>array(
                    'ref_name'=>'RefTypeMissionPrevention',
                    'ind_key'=>'refTypeMissionPrevention'
                ),
                'entity_key'=>'ind411s',
                'temp_key'=>'ind411s',
                'instance_of'=>'Ind411',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_CUSTOM_FUNCTION,
                                'from_function'=>function($ind_name,&$ind_data){
                                    $id_bila_soci_cons = $this->getBs()->getIdBilasocicons();
                                    return $id_bila_soci_cons;
                                }
                            )
                        )
                    )
                )
            ),
            'Ind412'=>array(
                'refs'=>array(
                    'ref_name'=>'RefActionPrevention',
                    'ind_key'=>'refActionPrevention'
                ),
                'entity_key'=>'ind412s',
                'temp_key'=>'ind412s',
                'instance_of'=>'Ind412',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_CUSTOM_FUNCTION,
                                'from_function'=>function($ind_name,&$ind_data){
                                    $id_bila_soci_cons = $this->getBs()->getIdBilasocicons();
                                    return $id_bila_soci_cons;
                                }
                            )
                        )
                    )
                )
            ),
            'Ind421'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclude'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind421s',
                'instance_of'=>'Ind421',
                /*'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R4211','R4212','R4213','R4214','R4215','R4216','R4217','R4218','R4219','R42110','R42111','R42112')
                                )
                            )
                        )
                    )
                ),*/
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind421AOTM'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclusive'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>'AOTM',
                        )
                    )
                ),
                'entity_key'=>'ind421s',
                'temp_key'=>'ind421AotmsTemp',
                'instance_of'=>'Ind421',
            ),
            'Ind421H'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclusive'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>'HH',
                        )
                    )
                ),
                'entity_key'=>'ind421s',
                'temp_key'=>'ind421HsTemp',
                'instance_of'=>'Ind421',
            ),
            'Ind422'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclude'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    )
                ),
                'entity_key'=>'ind422s',
                'temp_key'=>'ind422sTemp',
                'instance_of'=>'Ind422',
                /*'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'totalParFiliere',
                        'value_from'=>array(
                            '0'=>array(
                                'from_type'=>self::FROM_BUILD_IN_FUNCTION,
                                'from_name'=>'sum_ind_values',
                                'from_params'=>array(
                                    array('R4221','R4222','R4223','R4224','R4225','R42216','R42217','R4228')
                                )
                            )
                        )
                    )
                ),*/
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                ),
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCadreEmploi',
                            'refCategorie',
                            'idCate'
                        )
                    )
                )
            ),
            'Ind422AOTM'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclusive'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>'AOTM',
                        )
                    )
                ),
                'entity_key'=>'ind422s',
                'temp_key'=>'ind422AotmsTemp',
                'instance_of'=>'Ind422',
            ),
            'Ind422H'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCadreEmploi',
                        'ind_key'=>'refCadreEmploi',
                        'exclusive'=>array(
                            'join'=>array(
                                'current_repo.refFiliere'=>'rf'
                            ),
                            'fields'=>'rf.cdFili',
                            'values'=>'HH',
                        )
                    )
                ),
                'entity_key'=>'ind422s',
                'temp_key'=>'ind422HsTemp',
                'instance_of'=>'Ind422',
            ),
            'Ind423'=>array(
                'refs'=>array(
                    'ref_name'=>'RefInaptitude',
                    'ind_key'=>'refInaptitude',
                    'exclude'=>array(
                        'fields'=>'current_repo.blFili',
                        'values'=>'1',
                    )
                ),
                'entity_key'=>'ind423s',
                'temp_key'=>'ind423s',
                'instance_of'=>'Ind423'
            ),
            'Ind423Fili'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefFiliere',
                        'ind_key'=>'refFiliere',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdFili',
                            'values'=>self::CD_FILI_AOTM_HH,
                        )
                    ),
                    array(
                        'ref_name'=>'RefInaptitude',
                        'ind_key'=>'idInap',
                        'on_ref_key'=>'idInap',
                        'exclusive'=>array(
                            'fields'=>'current_repo.blFili',
                            'values'=>'1',
                        )
                    )
                ),
                'entity_key'=>'ind423sFili',
                'temp_key'=>'ind423sFili',
                'instance_of'=>'Ind423Fili',
            ),
            'Ind424'=>array(
                'entity_key'=>'ind424s',
                'temp_key'=>'ind424s',
                'instance_of'=>'Ind424',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'Ind431'=>array(
                'refs'=>array(
                    'ref_name'=>'RefActeViolencePhysique',
                    'ind_key'=>'refActeViolencePhysique'
                ),
                'entity_key'=>'ind431s',
                'temp_key'=>'ind431s',
                'instance_of'=>'Ind431',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            /*
            *   Formation
            */
            'Ind5111'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCategorie',
                    'ind_key'=>'refCategorie'
                ),
                'entity_key'=>'ind5111s',
                'temp_key'=>'ind5111s',
                'instance_of'=>'Ind5111'
            ),
            'Ind5112'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie'
                    ),array(
                        'ref_name'=>'RefFormation',
                        'ind_key'=>'refFormation'
                    )
                ),
                'entity_key'=>'ind5112s',
                'temp_key'=>'ind5112s',
                'instance_of'=>'Ind5112',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_cate = $ind_data->getRefCategorie()->getIdCate();
                            if($pre_ind!=null){
                                $pre_id_cate = $pre_ind->getRefCategorie()->getIdCate();
                                if($pre_id_cate!=$current_id_cate){
                                    $ind_data->setNewCateg(true);
                                }
                            }else{
                                $ind_data->setNewCateg(true);
                            }
                            if($next_ind!=null){
                                $next_id_cate = $next_ind->getRefCategorie()->getIdCate();
                                if($next_id_cate!=$current_id_cate){
                                    $ind_data->setLastCateg(true);
                                }
                            }else{
                                $ind_data->setLastCateg(true);
                            }
                        }
                    )
                )
            ),
            /*
            *   Droits Sociaux
            */
            'Ind5113'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie'
                    ),array(
                        'ref_name'=>'RefFormation',
                        'ind_key'=>'refFormation'
                    )
                ),
                'entity_key'=>'ind5113s',
                'temp_key'=>'ind5113s',
                'instance_of'=>'Ind5113',
                'group_by'=>array(
                    array(
                        'value_from'=>array(
                            'refCategorie',
                            'idCate'
                        )
                    )
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $next_ind = $ind_temp_key+1<$nb_in_temp ? $temp_inds[$ind_temp_key+1] : null;
                            $current_id_cate = $ind_data->getRefCategorie()->getIdCate();
                            if($pre_ind!=null){
                                $pre_id_cate = $pre_ind->getRefCategorie()->getIdCate();
                                if($pre_id_cate!=$current_id_cate){
                                    $ind_data->setNewCateg(true);
                                }
                            }else{
                                $ind_data->setNewCateg(true);
                            }
                            if($next_ind!=null){
                                $next_id_cate = $next_ind->getRefCategorie()->getIdCate();
                                if($next_id_cate!=$current_id_cate){
                                    $ind_data->setLastCateg(true);
                                }
                            }else{
                                $ind_data->setLastCateg(true);
                            }
                        }
                    )
                )
            ),
            'Ind5121'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiNonPermanent',
                    'ind_key'=>'refEmploiNonPermanent'
                ),
                'entity_key'=>'ind5121s',
                'temp_key'=>'ind5121s',
                'instance_of'=>'Ind5121'
            ),
            'Ind5122'=>array(
                'refs'=>array(
                    'ref_name'=>'RefEmploiNonPermanent',
                    'ind_key'=>'refEmploiNonPermanent'
                ),
                'entity_key'=>'ind5122s',
                'temp_key'=>'ind5122s',
                'instance_of'=>'Ind5122'
            ),
            'Ind513'=>array(
                'refs'=>array(
                    'ref_name'=>'RefValidationExperience',
                    'ind_key'=>'refValidationExperience'
                ),
                'entity_key'=>'ind513s',
                'temp_key'=>'ind513s',
                'instance_of'=>'Ind513',
                'extra_lines'=>array(
                    'for_keys'=>'type',
                    'for_values'=>array(2,3),
                    'other_value'=>1
                ),
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data,$ind_temp_key){
                            $temp_inds = $this->getTempIndContainer();
                            $nb_in_temp = $temp_inds->count();
                            $pre_ind = $ind_temp_key-1>=0 ? $temp_inds[$ind_temp_key-1] : null;
                            $current_type = $ind_data->getType();
                            if($pre_ind!=null){
                                $pre_type = $pre_ind->getType();
                                if($pre_type!=$current_type){
                                    $ind_data->setFirstType(true);
                                }
                            }else{
                                $ind_data->setFirstType(true);
                            }
                        }
                    )
                )
            ),
            'Ind613'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifGreve',
                    'ind_key'=>'refMotifGreve'
                ),
                'entity_key'=>'ind613s',
                'temp_key'=>'ind613s',
                'instance_of'=>'Ind613'
            ),
            'Ind6141'=>array(
                'refs'=>array(
                    'ref_name'=>'RefSanctionDisciplinaire',
                    'ind_key'=>'refSanctionDisciplinaire',
                ),
                'entity_key'=>'ind6141s',
                'temp_key'=>'ind6141s',
                'instance_of'=>'Ind6141',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name,&$ind_data){
                            $ind_ref_sanction_disciplinaire = $ind_data->getRefSanctionDisciplinaire();
                            if($ind_ref_sanction_disciplinaire->getBl614G1()){
                                $ind_data->setGroupe(1);
                            }else if($ind_ref_sanction_disciplinaire->getBl614G2()){
                                $ind_data->setGroupe(2);
                            }else if($ind_ref_sanction_disciplinaire->getBl614G3()){
                                $ind_data->setGroupe(3);
                            }else if($ind_ref_sanction_disciplinaire->getBl614G4()){
                                $ind_data->setGroupe(4);
                            }else if($ind_ref_sanction_disciplinaire->getBl614G5()){
                                $ind_data->setGroupe(5);
                            }else if($ind_ref_sanction_disciplinaire->getBl614G6()){
                                $ind_data->setGroupe(6);
                            }
                        }
                    )
                ),
                'after_move'=>array(
                    array(
                        'type'=>self::ON_EVENT_CUSTOM_FUNCTION,
                        'to_execute'=>function($ind_name){
                            $groupe1Ok = false;
                            $groupe2Ok = false;
                            $groupe3Ok = false;
                            $groupe4Ok = false;
                            $groupe5Ok = false;
                            $groupe6Ok = false;
                            $inds_temp = $this->getTempIndContainer();
                            //$inds_temp = $inds_temp->toArray();
                            foreach ($inds_temp as $temp_key => $ind) {
                                $current_group = $ind->getGroupe();
                                if($current_group==1){
                                    if(!$groupe1Ok){
                                        $groupe1Ok = true;
                                        $ind->setFirstGroupe1(true);
                                    }
                                }else if($current_group==2){
                                    if(!$groupe2Ok){
                                        $groupe2Ok = true;
                                        $ind->setFirstGroupe2(true);
                                    }
                                }else if($current_group==3){
                                    if(!$groupe3Ok){
                                        $groupe3Ok = true;
                                        $ind->setFirstGroupe3(true);
                                    }
                                }else if($current_group==4){
                                    if(!$groupe4Ok){
                                        $groupe4Ok = true;
                                        $ind->setFirstGroupe4(true);
                                    }
                                }else if($current_group==5){
                                    if(!$groupe5Ok){
                                        $groupe5Ok = true;
                                        $ind->setFirstGroupe5(true);
                                    }
                                }else if($current_group==6){
                                    if(!$groupe6Ok){
                                        $groupe6Ok = true;
                                        $ind->setFirstGroupe6(true);
                                    }
                                }
                                $inds_temp[$temp_key] = $ind;
                            }
                            //$this->resetTempIndContainer($inds_temp);
                        }
                    )
                )
            ),
            'Ind6143'=>array(
                'refs'=>array(
                    'ref_name'=>'RefSanctionDisciplinaire',
                    'ind_key'=>'refSanctionDisciplinaire',
                    'exclusive'=>array(
                        'fields'=>'current_repo.bl614G5',
                        'values'=>array('1'),
                    )
                ),
                'entity_key'=>'ind6143s',
                'temp_key'=>'ind6143s',
                'instance_of'=>'Ind6143',
            ),
            'Ind6144'=>array(
                'refs'=>array(
                    'ref_name'=>'RefSanctionDisciplinaire',
                    'ind_key'=>'refSanctionDisciplinaire',
                    'exclusive'=>array(
                        'fields'=>'current_repo.bl614G6',
                        'values'=>array('1'),
                    )
                ),
                'entity_key'=>'ind6144s',
                'temp_key'=>'ind6144s',
                'instance_of'=>'Ind6144',
            ),
            'Ind6142'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifSanctionDisciplinaire',
                    'ind_key'=>'refMotifSanctionDisciplinaire'
                ),
                'entity_key'=>'ind6142s',
                'temp_key'=>'ind6142s',
                'instance_of'=>'Ind6142',
            ),
            'Ind7141'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCategorie',
                    'ind_key'=>'refCategorie'
                ),
                'entity_key'=>'ind7141s',
                'temp_key'=>'ind7141s',
                'instance_of'=>'Ind7141',
            ),
            'Ind7142'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCategorie',
                    'ind_key'=>'refCategorie'
                ),
                'entity_key'  => 'ind7142s',
                'temp_key'=>'ind7142s',
                'instance_of'=>'Ind7142',
            ),
            /*
            *   RASSCT
            */
            'BscRassctAccidentTravail'=>array(
                'refs'=>array()
            ),
            'BscRassctMaladieProCaracPro'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMaladieProfessionnelle',
                    'ind_key'=>'refMaladieProfessionnelle'
                ),
                'entity_key'=>'bscRassctMaladieProCaracPros',
                'temp_key'=>'bscRassctMaladieProCaracPros',
                'instance_of'=>'BscRassctMaladieProCaracPro',
            ),
            'BscRassctNbMaladiePro'=>array(
                'refs'=>array(
                    'ref_name'=>'RefTypeActivite',
                    'ind_key'=>'refTypeActivite'
                ),
                'entity_key'=>'bscRassctNbMaladiePros',
                'temp_key'=>'bscRassctNbMaladiePros',
                'instance_of'=>'BscRassctNbMaladiePro',
            ),
            'BscRassctNbAccidentTravail'=>array(
                'refs'=>array(
                    'ref_name'=>'RefTypeActivite',
                    'ind_key'=>'refTypeActivite'
                ),
                'entity_key'=>'bscRassctNbAccidentTravails',
                'temp_key'=>'bscRassctNbAccidentTravails',
                'instance_of'=>'BscRassctNbAccidentTravail',
            ),
            'BscRassctNatureLesion'=>array(
                'refs'=>array(
                    'ref_name'=>'RefNatureLesion',
                    'ind_key'=>'refNatureLesion'
                ),
                'entity_key'=>'bscRassctNatureLesions',
                'temp_key'=>'bscRassctNatureLesions',
                'instance_of'=>'BscRassctNatureLesion',
            ),
            'BscRassctSiegeLesion'=>array(
                'refs'=>array(
                    'ref_name'=>'RefSiegeLesion',
                    'ind_key'=>'refSiegeLesion'
                ),
                'entity_key'=>'bscRassctSiegeLesions',
                'temp_key'=>'bscRassctSiegeLesions',
                'instance_of'=>'BscRassctSiegeLesion',
            ),
            'BscRassctElementMateriel'=>array(
                'refs'=>array(
                    'ref_name'=>'RefElementMateriel',
                    'ind_key'=>'refElementMateriel'
                ),
                'entity_key'=>'bscRassctElementMateriels',
                'temp_key'=>'bscRassctElementMateriels',
                'instance_of'=>'BscRassctElementMateriel',
            ),
            /*
            *   Handitorial
            */
            'BscHanditorialQuestionsBoethsCategorie'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCategorieBoeth',
                    'ind_key'=>'refCategorieBoeth'
                ),
                'entity_key'=>'bscHanditorialQuestionsBoeths',
                'temp_key'=>'bscHanditorialQuestionsBoeths',
                'instance_of'=>'BscHanditorialQuestionsBoeths',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialNatureHandicaps'=>array(
                'refs'=>array(
                    'ref_name'=>'RefNatureHandicapBoeth',
                    'ind_key'=>'refNatureHandicapBoeth'
                ),
                'entity_key'=>'bscHanditorialNatureHandicaps',
                'temp_key'=>'bscHanditorialNatureHandicaps',
                'instance_of'=>'BscHanditorialNatureHandicaps',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialAvisInaptitudes'=>array(
                'refs'=>array(
                    'ref_name'=>'RefInaptitudeBoeth',
                    'ind_key'=>'refInaptitudeBoeth'
                ),
                'entity_key'=>'bscHanditorialAvisInaptitudes',
                'temp_key'=>'bscHanditorialAvisInaptitudes',
                'instance_of'=>'BscHanditorialAvisInaptitudes',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialMesureInaptitudes'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMesureBoeth',
                    'ind_key'=>'refMesureBoeth'
                ),
                'entity_key'=>'bscHanditorialMesureInaptitudes',
                'temp_key'=>'bscHanditorialMesureInaptitudes',
                'instance_of'=>'BscHanditorialMesureInaptitudes',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialAvisInaptitudesAvant'=>array(
                'refs'=>array(
                    'ref_name'=>'RefInaptitudeBoeth',
                    'ind_key'=>'refInaptitudeBoeth'
                ),
                'entity_key'=>'bscHanditorialAvisInaptitudesAvant',
                'temp_key'=>'bscHanditorialAvisInaptitudesAvant',
                'instance_of'=>'BscHanditorialAvisInaptitudesAvant',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialMesureInaptitudesAvant'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMesureBoeth',
                    'ind_key'=>'refMesureBoeth'
                ),
                'entity_key'=>'bscHanditorialMesureInaptitudesAvant',
                'temp_key'=>'bscHanditorialMesureInaptitudesAvant',
                'instance_of'=>'BscHanditorialMesureInaptitudesAvant',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialAncienneteAgents'=>array(
                'entity_key'=>'bscHanditorialAncienneteAgents',
                'temp_key'=>'bscHanditorialAncienneteAgents',
                'instance_of'=>'BscHanditorialAncienneteAgents',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialStatutAgents'=>array(
                'refs'=>array(
                    'ref_name'=>'RefStatut',
                    'ind_key'=>'refStatut'
                ),
                'entity_key'=>'bscHanditorialStatutAgents',
                'temp_key'=>'bscHanditorialStatutAgents',
                'instance_of'=>'BscHanditorialStatutAgents',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialArticles'=>array(
                'refs'=>array(
                    'ref_name'=>'RefTypeCdd',
                    'ind_key'=>'refArticle'
                ),
                'entity_key'=>'bscHanditorialArticles',
                'temp_key'=>'bscHanditorialArticles',
                'instance_of'=>'BscHanditorialArticles',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialModeEntrees'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifArrivee',
                    'ind_key'=>'refMotifArrivee'
                ),
                'entity_key'=>'bscHanditorialModeEntrees',
                'temp_key'=>'bscHanditorialModeEntrees',
                'instance_of'=>'BscHanditorialModeEntrees',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialModeSortiesTitulaire'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifDepart',
                    'ind_key'=>'refMotifDepart'
                ),
                'entity_key'=>'bscHanditorialModeSortiesTitulaire',
                'temp_key'=>'bscHanditorialModeSortiesTitulaire',
                'instance_of'=>'BscHanditorialModeSortiesTitulaire',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialModeSortiesNonTitulaire'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMotifDepart',
                    'ind_key'=>'refMotifDepart'
                ),
                'entity_key'=>'bscHanditorialModeSortiesNonTitulaire',
                'temp_key'=>'bscHanditorialModeSortiesNonTitulaire',
                'instance_of'=>'BscHanditorialModeSortiesNonTitulaire',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialDerniersDiplomes'=>array(
                'refs'=>array(
                    'ref_name'=>'RefDomaineDiplome',
                    'ind_key'=>'refDomaineDiplome'
                ),
                'entity_key'=>'bscHanditorialDerniersDiplomes',
                'temp_key'=>'bscHanditorialDerniersDiplomes',
                'instance_of'=>'BscHanditorialDerniersDiplomes',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialCadreEmplois'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi'
                ),
                'entity_key'=>'bscHanditorialCadreEmplois',
                'temp_key'=>'bscHanditorialCadreEmploisTemp',
                'instance_of'=>'BscHanditorialCadreEmplois',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                ),
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                )
            ),
            'BscHanditorialMetiers'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMetier',
                    'ind_key'=>'refMetier'
                ),
                'entity_key'=>'bscHanditorialMetiers',
                'temp_key'=>'bscHanditorialMetiersTemp',
                'instance_of'=>'BscHanditorialMetiers',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                ),
                'print_for'=>array(
                    'refMetier',
                    'RefFamilleMetier',
                    'idFamilleMetier'
                )
            ),
            'BscHanditorialTempsComplets'=>array(
                'entity_key'=>'bscHanditorialTempsComplets',
                'temp_key'=>'bscHanditorialTempsComplets',
                'instance_of'=>'BscHanditorialTempsComplets',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialInaptEtReclaCadreEmplois'=>array(
                'refs'=>array(
                    'ref_name'=>'RefCadreEmploi',
                    'ind_key'=>'refCadreEmploi'
                ),
                'entity_key'=>'bscHanditorialInaptEtReclaCadreEmplois',
                'temp_key'=>'bscHanditorialInaptEtReclaCadreEmploisTemp',
                'instance_of'=>'BscHanditorialInaptEtReclaCadreEmplois',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                ),
                'print_for'=>array(
                    'refCadreEmploi',
                    'refFiliere',
                    'idFili'
                )
            ),
            'BscHanditorialInaptEtReclaMetiers'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMetier',
                    'ind_key'=>'refMetier'
                ),
                'entity_key'=>'bscHanditorialInaptEtReclaMetiers',
                'temp_key'=>'bscHanditorialInaptEtReclaMetiersTemp',
                'instance_of'=>'BscHanditorialInaptEtReclaMetiers',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                ),
                'print_for'=>array(
                    'refMetier',
                    'RefFamilleMetier',
                    'idFamilleMetier'
                )
            ),
            'BscHanditorialInaptEtReclaTempsComplets'=>array(
                'entity_key'=>'bscHanditorialInaptEtReclaTempsComplets',
                'temp_key'=>'bscHanditorialInaptEtReclaTempsComplets',
                'instance_of'=>'BscHanditorialInaptEtReclaTempsComplets',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            'BscHanditorialTempsPleins'=>array(
                'entity_key'=>'bscHanditorialTempsPleins',
                'temp_key'=>'bscHanditorialTempsPleins',
                'instance_of'=>'BscHanditorialTempsPleins',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                )
            ),
            /*
            *   GPEEC
            */
            'BscGpeecNbAgentsTituEmpPermaParFoncEtAge'=>array(
                'refs'=>array(
                    'ref_name'=>'RefMetier',
                    'ind_key'=>'refMetier'
                ),
                'entity_key'=>'bscGpeecNbAgentsTituEmpPermaParFoncEtAges',
                'temp_key'=>'bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp',
                'instance_of'=>'BscGpeecNbAgentsTituEmpPermaParFoncEtAge',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                ),
                'print_for'=>array(
                    'refMetier',
                    'RefFamilleMetier',
                    'idFamilleMetier'
                )
            ),
            'BscGpeecPlusNbAgentsParSpeEtAge'=>array(
                'refs'=>array(
                    'ref_name'=>'RefSpecialite',
                    'ind_key'=>'refSpecialite'
                ),
                'entity_key'=>'bscGpeecPlusNbAgentsParSpeEtAges',
                'temp_key'=>'bscGpeecPlusNbAgentsParSpeEtAgesTemp',
                'instance_of'=>'BscGpeecPlusNbAgentsParSpeEtAge',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idBilasocicons',
                        'value_from'=>array(
                            'bilanSocialConsolide',
                            'idBilasocicons',
                        )
                    )
                ),
                'print_for'=>array(
                    'refSpecialite',
                    'refDomaineSpecialite',
                    'idDomaineSpecialite'
                )
            ),
            'BscGpeecNiveauDiplome'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefDomaineDiplome',
                        'ind_key'=>'refDomaineDiplome',
                    )
                ),
                'entity_key'=>'bscGpeecNiveauDiplomes',
                'temp_key'=>'bscGpeecNiveauDiplomes',
                'instance_of'=>'BscGpeecNiveauDiplome',
                'on_move'=>array(
                    array(
                        'type'=>self::ON_MOVE_SET_IND_FIELD,
                        'ind_field'=>'idDomaineDiplome',
                        'value_from'=>array(
                            'refDomaineDiplome',
                            'idDomaineDiplome'
                        )
                    )
                )
            ),
            'BscDgclJoursCarenceTitulaire'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>array(' H','HH'),
                        )
                    )
                ),
                'entity_key'=>'bscDgclJoursCarenceTitulaires',
                'temp_key'=>'bscDgclJoursCarenceTitulaires',
                'instance_of'=>'BscDgclJoursCarenceTitulaire',
            ),
            'BscDgclJoursCarenceContractuel'=>array(
                'refs'=>array(
                    array(
                        'ref_name'=>'RefCategorie',
                        'ind_key'=>'refCategorie',
                        'exclude'=>array(
                            'fields'=>'current_repo.cdCate',
                            'values'=>array(' H','HH'),
                        )
                    )
                ),
                'entity_key'=>'bscDgclJoursCarenceContractuels',
                'temp_key'=>'bscDgclJoursCarenceContractuels',
                'instance_of'=>'BscDgclJoursCarenceContractuel',
            ),
        );

        $this->referencielConfig = array(
            'refCadreEmploi'=>array(
                'ref_dependency'=>array(
                    'refFiliere',
                    'refCategorie'
                ),
                'alias'=>'rce',
                'table'=>'referencielConfig'
            ),
            'refEmploiFonctionnel'=>array(
                'ref_dependency'=>array(
                    'refFiliere',
                ),
                'alias'=>'ref',
                'table'=>'refEmploiFonctionnel'
            ),
            'RefFamilleMetier'=>array(
                'ref_dependency'=>array(
                    'refDomaineProfessionnel',
                ),
                'alias'=>'rfm',
                'table'=>'refFamilleMetier'
            ),
            'refGrade'=>array(
                'ref_dependency'=>array(
                    'refCadreEmploi',
                ),
                'alias'=>'rg',
                'table'=>'refGrade'
            ),
             'refMetier'=>array(
                'ref_dependency'=>array(
                    'RefFamilleMetier',
                ),
                'alias'=>'rm',
                'table'=>'refMetier'
            ),
            'refPositionStatutaire'=>array(
                'ref_dependency'=>array(
                    'refGroupePositionStatutaire',
                ),
                'alias'=>'rps',
                'table'=>'refPositionStatutaire'
            ),
            'refSpecialite'=>array(
                'ref_dependency'=>array(
                    'refDomaineSpecialite',
                ),
                'alias'=>'rs',
                'table'=>'refSpecialite'
            ),
            'refCategorie'=>array(
                'alias'=>'rc',
                'table'=>'refCategorie'
            ),
            'refFiliere'=>array(
                'alias'=>'rf',
                'table'=>'refFiliere'
            ),
            'refDomaineProfessionnel'=>array(
                'alias'=>'rdp',
                'table'=>'refDomaineProfessionnel'
            ),
            'refGroupePositionStatutaire'=>array(
                'alias'=>'rgps',
                'table'=>'refGroupePositionStatutaire'
            ),
            'refDomaineSpecialite'=>array(
                'alias'=>'rds',
                'table'=>'ref_domaine_specialite'
            )
        );

        $this->build_in_function_dealer = array(
            'sum_ind_values'=>function($ind_data,$ind_name,$from_params){
                $total = 0;
                $sum_from = $this->tryKeysOver(array('sum_from',0),$from_params,array());
                foreach ($sum_from as $key => $ind_key) {
                    $ind_value_get_method = 'get'.ucfirst($ind_key);
                    $total += is_callable($ind_data,$ind_value_get_method) ? $ind_data->$ind_value_get_method() : 0;
                }
                return $total;
            }
        );
    }
    public function getBs(){
    	return $this->bs;
    }
    public function setBs(&$bs){
    	$this->bs = $bs;
    }
    public function getUser(){
    	return $this->user;
    }
    public function setUser($user){
    	$this->user = $user;
    }
    public function getTempIndContainer(){
        return $this->temp_ind_container;
    }
    public function setTempIndContainer($temp_ind_container){
        $this->temp_ind_container = $temp_ind_container;
    }
    public function resetTempIndContainer($reset_with=null){
        $reset = $reset_with==null ? new ArrayCollection() : $reset_with;
        $reset = is_array($reset) && !($reset instanceof ArrayCollection) ? new ArrayCollection($reset) : $reset;
        $this->temp_ind_container = $reset;
    }
    public function addToTempIndContainer($ind_to_add){
        $this->temp_ind_container->add($ind_to_add);
    }
    public function getBuildIndFunctionDealer(){
        return $this->build_in_function_dealer;
    }
    public function getBuildIndFunction($function_key){
        $function = $this->tryKeysOver($function_key,$this->getBuildIndFunctionDealer());
        return $function;
    }
    /*
    *   fonctions de gestion de la config des indicateurs
    */
    private function getIndConfig($ind_name=null){
        $config = $this->indConfig;
        if($ind_name!=null){
            $config = isset($config[$ind_name]) ? $config[$ind_name] : null;
        }
        return $config;
    }

    private function getIndRefs($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $refs = isset($ind_config['refs']) ? $ind_config['refs'] : null;
        if($this->getRefName($refs) != null){
            $refs = array($refs);
        }
        return $refs;
    }
    private function hasIndRefs($ind_name,$ref_type=null){
        $refs = $this->getIndRefs($ind_name);
        $has_ref = false;
        if($ref_type!=null && $refs!=null){
            foreach ($refs as $key => $ref_config) {
                $temp_ref_type = $this->getRefType($ref_config);
                if($temp_ref_type==$ref_type){
                    $has_ref = true;
                    break;
                }
            }
        }else{
            $has_ref = $refs!=null && count($refs)>0;
        }
        return $has_ref;
    }
    private function getIndRefByName($ind_name,$ref_name){
        $refs = $this->getIndRefs($ind_name);
        $ref = null;
        foreach ($refs as $key => $ref_config) {
            if($ref_name==$this->getRefName($ref_config)){
                $ref = $ref_config;
            }
        }
        return $ref;
    }
    private function getIndEntityKey($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $entity_key = isset($ind_config['entity_key']) ? $ind_config['entity_key'] : null;
        return $entity_key;
    }
    private function getIndGetMethod($ind_name){
        $entity_key = $this->getIndEntityKey($ind_name);
        $ind_get_method = $entity_key!=null ? 'get'.ucfirst($entity_key) : null;
        return $ind_get_method;
    }
    private function getIndSetMethod($ind_name){
        $entity_key = $this->getIndEntityKey($ind_name);
        $ind_set_method = $entity_key!=null ? 'set'.ucfirst($entity_key) : null;
        return $ind_set_method;
    }
    public function getIndsByName($ind_name){
    	$bs = $this->getBs();
        $ind_get_method = $this->getIndGetMethod($ind_name);
        $inds = $ind_get_method!=null && method_exists($bs, $ind_get_method)  ? $bs->$ind_get_method() : null;
        return $inds;
    }
    public function setIndsByName($ind_name,$inds_value){
    	$bs = $this->getBs();
        $ind_set_method = $this->getIndSetMethod($ind_name);
        //$inds_value = is_array($inds_value) ? $inds_value : array($inds_value);
        if($ind_set_method!=null) $bs->$ind_set_method($inds_value);//new ArrayCollection($inds_value));
    }
    private function getIndEntityClass($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $entity_class = isset($ind_config['instance_of']) ? $ind_config['instance_of'] : null;
        return 'Bilan_Social\Bundle\ConsoBundle\Entity\\'.$entity_class;
    }
    private function getIndTempKey($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_temp_key = isset($ind_config['temp_key']) ? $ind_config['temp_key'] : null;
        return $ind_temp_key;
    }
    private function getBsIndTempKey($ind_name){
        $bs_ind_temp_key = $this->getIndTempKey($ind_name);
        if($bs_ind_temp_key==null){
        	$ind_entity_key = $this->getIndEntityKey($ind_name);
        	$bs_ind_temp_key = $ind_entity_key!=null ? $ind_entity_key.'Temp' : null;
        }
        return $bs_ind_temp_key;
    }
    private function getBsIndTempGetMethod($ind_name){
        $bs_ind_temp_key = $this->getBsIndTempKey($ind_name);
        $bs_ind_temp_get_method = 'get'.ucfirst($bs_ind_temp_key);
        return $bs_ind_temp_get_method;
    }
    private function getBsIndTempSetMethod($ind_name){
        $bs_ind_temp_key = $this->getBsIndTempKey($ind_name);
        $bs_ind_temp_set_method = 'set'.ucfirst($bs_ind_temp_key);
        return $bs_ind_temp_set_method;
    }
    private function getIndPrintFor($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_print_for = isset($ind_config['print_for']) ? $ind_config['print_for'] : null;
        return $ind_print_for;
    }
    private function getIndOnMove($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_on_move = isset($ind_config['on_move']) ? $ind_config['on_move'] : null;
        return $ind_on_move;
    }
    private function getIndAfterMove($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_after_move = isset($ind_config['after_move']) ? $ind_config['after_move'] : null;
        return $ind_after_move;
    }
    private function getIndGroupBy($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_group_by = isset($ind_config['group_by']) ? $ind_config['group_by'] : null;
        return $ind_group_by;
    }
    private function getIndMakeGroup($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_make_group = isset($ind_config['make_group']) ? $ind_config['make_group'] : null;
        return $ind_make_group;
    }
    private function getIndExtraLine($ind_name){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_extra_line = isset($ind_config['extra_lines']) ? $ind_config['extra_lines'] : null;
        return $ind_extra_line;
    }
    private function getIndExtraLineFields($ind_name){
        $extra_line_config = $this->getIndExtraLine($ind_name);
        $extra_line_fields = array();
        if($extra_line_config!=null){
            $extra_line_fields = $this->tryKeysOver('for_keys',$extra_line_config,array());
            $extra_line_fields = is_array($extra_line_fields) ? $extra_line_fields : array($extra_line_fields);
        }
        return $extra_line_fields;
    }
    private function getIndExtraLineValues($ind_name){
        $extra_line_config = $this->getIndExtraLine($ind_name);
        $extra_line_values = array();
        if($extra_line_config!=null){
            $extra_line_values = $this->tryKeysOver('for_values',$extra_line_config,array());
            $extra_line_values = is_array($extra_line_values) ? $extra_line_values : array($extra_line_values);
        }
        return $extra_line_values;
    }
    private function getIndExtraLineOtherValue($ind_name){
        $extra_line_config = $this->getIndExtraLine($ind_name);
        $extra_line_other_value = array();
        if($extra_line_config!=null){
            $extra_line_other_value = $this->tryKeysOver('other_value',$extra_line_config,array());
            $extra_line_other_value = is_array($extra_line_other_value) ? $extra_line_other_value : array($extra_line_other_value);
        }
        return $extra_line_other_value;
    }
    private function getIndExtraDependencyOptions($ind_name,$dependency_key=null){
        $ind_config = $this->getIndConfig($ind_name);
        $ind_extra_dependency_options = isset($ind_config['extra_dependency_options']) ? $ind_config['extra_dependency_options'] : null;
        if($ind_extra_dependency_options!=null && isset($dependency_key) && $dependency_key != null){
            $ind_extra_dependency_options = isset($ind_extra_dependency_options[$dependency_key]) ? $ind_extra_dependency_options[$dependency_key] : null;
        }
        return $ind_extra_dependency_options;
    }
    /*
    *   fonctions d'initialisation des indicateurs
    */

    private function getRefName($ref_config){
		$ref_name = isset($ref_config['ref_name']) ? $ref_config['ref_name'] : null;
		return $ref_name;
    }
    private function getRefType($ref_config){
        $ref_type = isset($ref_config['ref_type']) ? $ref_config['ref_type'] : null;
        return $ref_type;
    }
    private function getRefIndKey($ref_config){
		$ref_ind_key = isset($ref_config['ind_key']) ? $ref_config['ind_key'] : null;
		return $ref_ind_key;
    }
    private function getOnRefKey($ref_config){
        $on_ref_key = isset($ref_config['on_ref_key']) ? $ref_config['on_ref_key'] : null;
        return $on_ref_key;
    }
    private function getRefChild($ref_config){
		$ref_child = isset($ref_config['child']) ? $ref_config['child'] : null;
		return $ref_child;
    }
    private function getRefWhereCol($ref_config){
		$ref_where_col = isset($ref_config['where_col']) ? $ref_config['where_col'] : null;
		return $ref_where_col;
    }
    private function getRefExclude($ref_config){
        $ref_exclude_config = isset($ref_config['exclude']) ? $ref_config['exclude'] : null;
        return $ref_exclude_config;
    }
    private function getRefInclude($ref_config){
        $ref_include_config = isset($ref_config['include']) ? $ref_config['include'] : null;
        return $ref_include_config;
    }
    private function getRefExclusive($ref_config){
        $ref_exclusive_config = isset($ref_config['exclusive']) ? $ref_config['exclusive'] : null;
        return $ref_exclusive_config;
    }
    private function getRefIndGetMethod($ref_config){
    	$ind_key = $this->getRefIndKey($ref_config);
    	$ind_key = $ind_key == null ? $this->getRefName($ref_config) : $ind_key;
    	$ref_ind_get_method = $ind_key!=null ? 'get'.ucfirst($ind_key) : null;
    	return $ref_ind_get_method;
    }
    private function getRefIndSetMethod($ref_config){
    	$ind_key = $this->getRefIndKey($ref_config);
    	$ind_key = $ind_key == null ? $this->getRefName($ref_config) : $ind_key;
    	$ref_ind_set_method = $ind_key!=null ? 'set'.ucfirst($ind_key) : null;
    	return $ref_ind_set_method;
    }
    private function getOnRefGetMethod($ref_config){
        $on_ref_key = $this->getOnRefKey($ref_config);
        $on_ref_get_method = $on_ref_key!=null ? 'get'.ucfirst($on_ref_key) : null;
        return $on_ref_get_method;
    }
    private function getRefDependencyConfig($ref_name,$config_name=null){
        $ref_dependency_config = isset($this->referencielConfig[$ref_name]) ? $this->referencielConfig[$ref_name] : null;
        if($ref_dependency_config!=null && $config_name!=null){
            $ref_dependency_config = isset($ref_dependency_config[$config_name]) ? $ref_dependency_config[$config_name] : null;
        }
        return $ref_dependency_config;
    }
    private function processToRefDependency($ref_ind_key,&$join_pile,&$where_pile,&$group_by_pile,$ind_name=null,$pre_table_alias = false){
        //$ref_name = $this->getRefName($ref_config);
        //$ref_ind_key = $this->getRefIndKey($ref_config);
     
        //$ref_dependency_config = $this->referencielConfig[$ref_name];
        $ref_dependency = $this->getRefDependencyConfig($ref_ind_key,'ref_dependency');//isset($ref_dependency_config['ref_dependency']) ? $ref_dependency_config['ref_dependency'] : false;
        $ref_alias = $this->getRefDependencyConfig($ref_ind_key,'alias');
        $ref_table_name = $this->getRefDependencyConfig($ref_ind_key,'table');
        $ref_table_name = $ref_table_name!=null ? $ref_table_name :  $ref_ind_key;
        
        if($pre_table_alias!=false){
            $extra_dependency_options = $this->getIndExtraDependencyOptions($ind_name,$ref_ind_key);
            if($extra_dependency_options!=null){
                $current_ref_dependency_config = array_merge(array('name'=>$ref_ind_key),$extra_dependency_options);
                $ref_dependency_name = isset($current_ref_dependency_config['name']) ? $current_ref_dependency_config['name'] : null;
                $ref_dependency_join_on_expr = isset($current_ref_dependency_config['on_expr']) ? $current_ref_dependency_config['on_expr'] : null;
                $ref_dependency_join_function = isset($current_ref_dependency_config['join_function']) ? $current_ref_dependency_config['join_function'] : null;
                if($ref_dependency_name != null && ($ref_dependency_join_on_expr != null || $ref_dependency_join_function != null)){
                    $ref_dependency_join_key_str = $pre_table_alias.'.'.$ref_dependency_name;
                    $ref_dependency_alias = $this->getRefDependencyConfig($ref_dependency_name,'alias');
                    $ref_dependency_join_config = array(
                        'alias'=>$ref_dependency_alias
                    );
                    if($ref_dependency_join_function != null){
                        $ref_dependency_join_config['function']=$ref_dependency_join_function;
                    }
                    if($ref_dependency_join_on_expr != null){
                        $ref_dependency_join_config['on_expr']=$ref_dependency_join_on_expr;
                    }
                    $join_pile[$ref_dependency_join_key_str] = $ref_dependency_join_config;
                }
                $current_ref_dependency_group_by_col = isset($current_ref_dependency_config['group_by_coll']) ? $current_ref_dependency_config['group_by_coll'] : null;
                $current_ref_dependency_group_by_raw = isset($current_ref_dependency_config['group_by']) ? $current_ref_dependency_config['group_by'] : null;
                if($current_ref_dependency_group_by_col!=null || $current_ref_dependency_group_by_raw!=null){
                    $group_by_dql = $current_ref_dependency_group_by_raw!=null ? $current_ref_dependency_group_by_raw : $ref_alias.'.'.$current_ref_dependency_group_by_col;
                    $group_by_pile[]=$group_by_dql;
                }
                $current_ref_dependency_is_nullable = isset($current_ref_dependency_config['is_nullable']) ? $current_ref_dependency_config['is_nullable'] : false;
                if($current_ref_dependency_is_nullable){
                    $where_condition_str = '('.$ref_alias.'.blVali = false OR '.$ref_alias.'.blVali IS NULL)';
                }
            }
            else{
                $join_key_str = $pre_table_alias.'.'.$ref_ind_key;
                if(!isset($join_pile[$join_key_str])){
                    $join_pile[$join_key_str] = $ref_alias;
                }
                $where_condition_str = $ref_alias.'.blVali = false';
            }
        }else{
            $ref_alias = 'current_repo';
            $where_condition_str = $ref_alias.'.blVali = false';
        }
        
        $where_pile[] = array('condition'=>$where_condition_str);
        
        if($ref_dependency!==null){
            foreach ($ref_dependency as $key => $ref_dependency_name) {
                $this->processToRefDependency($ref_dependency_name,$join_pile,$where_pile,$group_by_pile,$ind_name,$ref_alias);
            }
        }
    }
    private function getRefValues($ref_config,$ind_name=null,$get_ref_entity=true){
    	$get_ref_entity = $get_ref_entity == false ? false : true;
        $ref_type = $this->getRefType($ref_config);
        $ref_type = $ref_type != null ? $ref_type : self::REF_TYPE_DATABASE;
        $ref_name = $this->getRefName($ref_config);
        $ref_ind_key = $this->getRefIndKey($ref_config);
        $on_ref_to_set_get_method = $this->getOnRefGetMethod($ref_config);
        if($ref_type==self::REF_TYPE_DATABASE){
        	$where_cond = array(array('condition'=>'current_repo.blVali = false'));
            $group_by = array();
            $exclusive_config = $this->getRefExclusive($ref_config);
            $join = array();
            $this->processToRefDependency($ref_ind_key,$join,$where_cond,$group_by,$ind_name);
            if($exclusive_config!=null){
                $temp_join = isset($exclusive_config['join']) ? $exclusive_config['join'] : array();
                $temp_join_where = $this->processJoinConfig($temp_join);
                if(!empty($temp_join_where)) $where_cond = array_merge($where_cond,$temp_join_where);
                $join = $this->array_merge_unique($join,$temp_join);
                $where_fields = $exclusive_config['fields'];
                $multiple_fields = is_array($where_fields) && count($where_fields)>1;
                $where_fields = is_array($where_fields) ? $where_fields : array($where_fields);
                $where_params = $exclusive_config['values'];
                $where_magazine = array();
                $cpt_param = 0;
                foreach ($where_fields as $key => $field) {
                    $param = is_array($where_params) && $multiple_fields ? $where_params[$cpt_param] : $where_params;
                    $param_to_bind = array();
                    $multiple_param_for_field = (!$multiple_fields && is_array($param)) || ($multiple_fields && is_array($param));
                    $condition = null;
                    if($param===null){
                        $condition = $field.' IS NULL ';
                    }else if($multiple_param_for_field){
                        $keys_for_null_values = array_keys($param,null,true);
                        for($i=0;$i<count($keys_for_null_values);$i++){
                            if($i=0){
                                $condition = $field.' IS NULL ';
                                $where_magazine[] = array(
                                    'condition'=>$condition,
                                    'params'=>array()
                                );
                            }
                            $key_to_remove = $keys_for_null_values[$i] - $i;
                            $param = array_slice($param, $key_to_remove,1);
                        }
                        $condition = $field.' IN (';
                        foreach($param as $p_key => $p_value){
                            $condition .= $p_key==0 ? "" : ", ";
                            $condition .= '?'.$cpt_param.' ';
                            $param_to_bind[] = $param;
                            $cpt_param++;
                        }
                        $condition .= ')';
                    }
                    else{
                        $condition = $field.' IN (?'.$cpt_param.') ';
                        $param_to_bind = $where_params;
                    }
                    $where_magazine[] = array(
                        'condition'=>$condition,
                        'params'=>$param_to_bind
                    );
                    $cpt_param++;
                }
                $where_cond = $this->array_merge_unique($where_cond,$where_magazine);
            }else{

                $exclude_config = $this->getRefExclude($ref_config);
                $include_config = $this->getRefInclude($ref_config);
                if($exclude_config!=null){
                    $temp_join = isset($exclude_config['join']) ? $exclude_config['join'] : array();
                    $join = $this->array_merge_unique($join,$temp_join);
                    $where_fields = is_array($exclude_config['fields']) ? $exclude_config['fields'] : array($exclude_config['fields']);
                    $multiple_fields = is_array($where_fields) && count($where_fields)>1;
                    $where_params = $exclude_config['values'];
                    $where_magazine = array();
                    $cpt_param = 0;
                    foreach ($where_fields as $key => $field) {
                        $param = is_array($where_params) && $multiple_fields ? $where_params[$cpt_param] : $where_params;;//$where_params[$cpt_param];
                        $multiple_param_for_field = (!$multiple_fields && is_array($param)) || ($multiple_fields && is_array($param));
                        $condition = null;
                        if($param===null){
                            $condition = $field.' IS NOT NULL ';
                        }else{
                            if($multiple_param_for_field){
                                $condition = $field.' NOT IN (';
                                foreach($param as $cpt_field_param => $field_param_value){
                                    $condition .= $cpt_field_param>0 ? ',' : '';
                                    $condition .= ' ?'.$cpt_field_param.'';
                                }
                                $condition .= ') ';

                            }else{
                                $condition = $field.' NOT IN (?'.$cpt_param.') ';
                            }
                        }
                        $where_magazine[] = array(
                            'condition'=>$condition,
                            'params'=>$where_params
                        );
                        $cpt_param++;
                    }
                    $where_cond = $this->array_merge_unique($where_cond,$where_magazine);
                }
                if($include_config!=null){
                    $temp_join = isset($include_config['join']) ? $include_config['join'] : array();
                    $join = $this->array_merge_unique($join,$temp_join);
                    $where_fields = $include_config['fields'];
                    $multiple_fields = is_array($where_fields) && count($where_fields)>1;
                    $where_fields = is_array($where_fields) ? $where_fields : array($where_fields);
                    $where_params = $include_config['values'];
                    $where_magazine = array();
                    $cpt_param = 0;
                    foreach ($where_fields as $key => $field) {
                        $prev_link = 'and';
                        $param = is_array($where_params) && $multiple_fields ? $where_params[$cpt_param] : $where_params;
                        $param_to_bind = array();
                        $multiple_param_for_field = (!$multiple_fields && is_array($param)) || ($multiple_fields && is_array($param));
                        $condition = null;
                        $param_to_bind = array();
                        $close_group = false;
                        $cpt_param_for_field = 0;
                        if($multiple_param_for_field){
                            $prev_link = $cpt_param_for_field==0 ? 'and' : 'or';
                            $cpt_param_for_field++;
                            $keys_for_null_values = array_keys($param,null,true);
                            for($i=0;$i<count($keys_for_null_values);$i++){
                                if($i==0){
                                    $condition = $field.' IS NULL ';
                                    $where_magazine[] = array(
                                        'condition'=>$condition,
                                        'params'=>array(),
                                        'open_group'=>true,
                                        'prev_link'=>$prev_link
                                    );
                                }
                                $key_to_remove = $keys_for_null_values[$i] - $i;
                                array_splice($param, $key_to_remove,1);
                           }
                            $close_group = true;
                            $prev_link = 'or';
                                $condition = $field.' IN (';
                                foreach($param as $cpt_field_param => $field_param_value){
                                    $condition .= $cpt_field_param>0 ? ',' : '';
                                    $condition .= ' ?'.$cpt_param.'';
                                }
                                $condition .= ') ';

                            $param_to_bind = $param;
                        }
                        else if($param===null){
                            $condition = $field.' IS NULL ';
                        }else{
                            $condition = $field.' IN (?'.$cpt_param.') ';
                            $param_to_bind = $param;
                        }
                        $where_magazine[] = array(
                            'condition'=>$condition,
                            'params'=>$param_to_bind,
                            'close_group'=>$close_group,
                            'prev_link'=>$prev_link
                        );
                        $cpt_param++;
                    }
                    $where_cond = $this->array_merge_unique($where_cond,$where_magazine);
                }
            }
        	/*if($parent_ref!=null){
        		$ref_where_coll = $this->getRefWhereCol();
        		$where_cond[$ref_where_coll]=$parent_ref;
        	}*/
            $order_by = array('current_repo.nmOrdre'=>'ASC');
            $query = $this->em->getRepository('ReferencielBundle:'.$ref_name)->createQB(null,$where_cond,$join,$order_by,$group_by)->getQuery();
           
        	$ref_values = $query->getResult();

            if(!$get_ref_entity && $on_ref_to_set_get_method!=null){
                $result = array();
                foreach ($ref_values as $key => $ref) {
                    $result[] = $ref->$on_ref_to_set_get_method();
                }
                $ref_values = $result;
            }
        }else if($ref_type==self::REF_TYPE_MANUAL){
            $ref_values = $ref_config['ref_data'];
        }
    	return $ref_values;
    }

    public function processJoinConfig(&$join_config){
        foreach ($join_config as $key => &$join) {
            
        }
    }
    public function getIndRefData($ref_config,$ind_data){
        $ref_ind_get_method = $this->getRefIndGetMethod($ref_config);
        $ind_ref_data = $ref_ind_get_method!= null ? $ind_data->$ref_ind_get_method() : null;
        return $ind_ref_data;
    }
    public function getIndOneRefData($ind_name,$ind_data,$wich_one=1){
        $refs_config = $this->getIndRefs($ind_name);
        $ref_config = isset($refs_config[$wich_one-1]) ? $refs_config[$wich_one-1] : null;
        $ref_data = null;
        if($ref_config!=null) {
            $ref_data = $this->getIndRefData($ref_config,$ind_data);
        }
        return $ref_data;
    }
    private function ProcessToIndsRefsPairs($ind_name,$refs_to_process=null ,$current_pair=null ){

        $refs_config = is_array($refs_to_process) ? $refs_to_process : $this->getIndRefs($ind_name);
        $current_ref = isset($refs_config[0]) ? $refs_config[0] : null;
        $refs_pairs = array();
        if($refs_to_process!=null){
        }
        if($current_ref!=null){
            $ref_values = $this->getRefValues($current_ref,$ind_name,false);
            if($next_ref = isset($refs_config[1])){
                array_shift($refs_config);
            }
            foreach ($ref_values as $key => $value) {
                $pair = $current_pair == null ? array() : $current_pair;
                $pair[] = $value;
                #$pair['refs'][] = $current_ref;
                if($next_ref){
                    $pairs_to_merge = $this->ProcessToIndsRefsPairs($ind_name,$refs_config,$pair);
                    $refs_pairs = array_merge($refs_pairs,$pairs_to_merge);
                }else{
                    $refs_pairs[] = $pair;
                }
            }
        }
        return $refs_pairs;
    }
    public function getIndsRefsPairs($ind_name){
        $refs_pairs = $this->ProcessToIndsRefsPairs($ind_name);
        $extra_line = $this->getIndExtraLine($ind_name);
        if($extra_line!=null){
            $for_fields = $this->getIndExtraLineFields($ind_name);
            $for_values = $this->getIndExtraLineValues($ind_name);
            $other_value = $this->getIndExtraLineOtherValue($ind_name);
            $base_pair_length = !empty($refs_pairs) ? count($refs_pairs[0]) : 0;
            $extra_pairs = array();
            $nb_extra_pair = count($for_values);
            for($i=0;$i<$nb_extra_pair;$i++){
                $extra_pairs[] = array_fill(0,$base_pair_length,null);
            }
            foreach ($for_fields as $field_key => $for_field) {
                $field_values = empty($for_values) ? array() : is_array($for_values[0]) ? $for_values[0] : $for_values;
                $extra_ref_value = $other_value[$field_key];
                foreach($refs_pairs as $pair_key => $ref_pair){
                    $ref_pair[] = $extra_ref_value;
                    $refs_pairs[$pair_key] = $ref_pair;
                }
                foreach ($field_values as $key => $field_value) {
                    $extra_pairs[$key][]=$field_value;
                }
            }
            $refs_pairs = array_merge($refs_pairs,$extra_pairs);
        }
        return $refs_pairs;
    }
    public function getIndDataRefsPair($ind_name,$ind_data){
        $refs_config = $this->getIndRefs($ind_name);
        $pair = array();//array('values'=>array(),'refs'=>array())
        foreach ($refs_config as $key => $ref_config) {
            $ref_data = $this->getIndRefData($ref_config,$ind_data);
            $pair[] = $ref_data;
            //$pair['refs'][] = $ref_config;
        }
        $extra_line = $this->getIndExtraLine($ind_name);
        if ($extra_line != null) {
            $for_fields = $this->getIndExtraLineFields($ind_name);
            $for_values = $this->getIndExtraLineValues($ind_name);
            $other_value = $this->getIndExtraLineOtherValue($ind_name);
            $base_pair_length = count($pair);
            foreach ($for_fields as $field_key => $for_field) {
                $field_get_method = $this->getIndFieldGetMethod($for_field, $ind_data);
                $extra_ref_value = $ind_data->$field_get_method();
                $pair[] = $extra_ref_value;
            }
        }
        return $pair;
    }
    private function processIndRefsPurge($ind_name,$inds_to_purge_against,$ref_to_purge, $parent_ref=null){
        $purged_refs = array();
        $refs_value_to_purge = array();
        $ref_ind_key = $this->getRefIndKey($ref_to_purge);
        $ref_ind_key = $this->getRefName($ref_to_purge);
        $ref_values = $this->getRefValues($ref_to_purge,$ind_name,$parent_ref);
        $ref_child = $this->getRefChild($ref_to_purge);
        $ref_ind_get_method = $this->getRefIndGetMethod($ref_to_purge);
        $refs_value_to_purge = $ref_values;
        if($ref_child){
        	foreach ($refs_value_to_purge as $key => $ref_value) {
        		$purged_refs[] = array(
        			'value'=>$ref_value,
        			'config'=>$ref_to_purge,
        			'child_value'=>$this->processIndRefsPurge($ind_name,$inds_to_purge_against,$ref_child,$ref_value)
        		);
        	}
        }else{
        	foreach ($inds_to_purge_against as $key => $ind) {
	        	$ref_to_compare = $ind->$ref_ind_get_method();
	        	if(($ref_to_purge_index = array_search($ref_to_compare, $refs_value_to_purge)) !== false){
	        		array_splice($refs_value_to_purge, $ref_to_purge_index,1);
	        	}
	        }
	        $purged_refs[] = array(
	        	'value'=>$refs_value_to_purge,
    			'config'=>$ref_to_purge,
	        );
        }
       	return $purged_refs;
    }
    public function getPurgedIndRefs($ind_name){
        $inds_in_bs = $this->getIndsByName($ind_name);
        $ind_refs = $this->getIndRefs($ind_name);
        $purged_refs = $this->processIndRefsPurge($ind_name,$inds_in_bs,$ind_refs);
        return $purged_refs;
    }
    public function addIndToTempByName($ind_name,$ind_value){
    	//$inds_temp_key = $this->getBsIndTempKey($ind_name);
    	$is_collection = $this->isCollection($ind_value);
    	$inds_value = is_array($ind_value) || $is_collection ? $ind_value : array($ind_value);
    	//if($bs_ind_temp_get_method!=null && $bs_ind_temp_set_method != null){
    		//$temp_inds = $this->getBs()->$bs_ind_temp_get_method();
    		//$temp_inds = $temp_inds == null ? new ArrayCollection() : $temp_inds;
    		foreach ($inds_value as $key => $ind) {
    			//$temp_inds->add($ind);
                $this->addToTempIndContainer($ind);
    		}
    		//$this->getBs()->$bs_ind_temp_set_method($temp_inds);
    	//}
    }
    public function addBsIndToTempByName($ind_name){
    	$inds_in_bs = $this->getIndsByName($ind_name);
    	$this->addIndToTempByName($ind_name,$inds_in_bs);
    }
    private function createNewInd($ind_name){
        $ind_class = $this->getIndEntityClass($ind_name);
        $cd_util = $this->getUser()->getUsername();
        $now = new \DateTime('NOW');
        $temp_ind = new $ind_class();
        $temp_ind->setBilanSocialConsolide($this->getBs());
        $temp_ind->setDtCrea($now);
        $temp_ind->setCdUtilcrea($cd_util);
        return $temp_ind;
    }
    private function createNewIndWithRef($ind_name,$refs_pair){
        //$ind_class = $this->getIndEntityClass($ind_name);
        $ind_refs = $this->getIndRefs($ind_name);
        //$cd_util = $this->getUser()->getUsername();
        //$now = new \DateTime('NOW');
        $temp_ind = $this->createNewInd($ind_name);//new $ind_class();
        $extra_line = $this->getIndExtraLine($ind_name);
        $for_fields = $this->getIndExtraLineFields($ind_name);
        $for_values = $this->getIndExtraLineValues($ind_name);
        $other_value = $this->getIndExtraLineOtherValue($ind_name);
        $cpt_extra_key_done = 0;
        foreach ($refs_pair as $ref_key => $ref_value) {
            if(isset($ind_refs[$ref_key])){
                $ref_config =  $ind_refs[$ref_key];
                $ref_ind_set_method = $this->getRefIndSetMethod($ref_config);
                $temp_ind->$ref_ind_set_method($ref_value);
            }else if($extra_line!=0){
                $field = $for_fields[$cpt_extra_key_done];
                $field_set_method = 'set'.ucfirst($field);
                $temp_ind->$field_set_method($ref_value);
                $cpt_extra_key_done++;
            }
        }
        /*$temp_ind->setBilanSocialConsolide($this->getBs());
        $temp_ind->setDtCrea($now);
        $temp_ind->setCdUtilcrea($cd_util);*/
        return $temp_ind;
    }
    public function initIndicateurByName($ind_name){
        $this->resetTempIndContainer();
    	//$this->addBsIndToTempByName($ind_name);
        $has_refs = $this->getIndRefs($ind_name)!=null;
        $ind_class = $this->getIndEntityClass($ind_name);
        $cd_util = $this->getUser()->getUsername();
        $now = new \DateTime('NOW');
        $inds_in_bs = $this->getIndsByName($ind_name);
        if ($has_refs) {
            $inds_refs_values_pairs = $this->getIndsRefsPairs($ind_name);
            //$missing_refs = $this->getPurgedIndRefs($ind_name);
            $inds_in_bs = $inds_in_bs == null ? array() : $inds_in_bs;
            foreach ($inds_in_bs as $key => $ind) {
                $ind_ref_pair = $this->getIndDataRefsPair($ind_name,$ind);
                $index_of_pair = array_search($ind_ref_pair, $inds_refs_values_pairs);
                if ($index_of_pair !== false) {
                    array_splice($inds_refs_values_pairs, $index_of_pair, 1);
                    $this->addIndToTempByName($ind_name,$ind);
                }
            }
            foreach ($inds_refs_values_pairs as $key => $ind_refs_values_pair) {
                $temp_ind = $this->createNewIndWithRef($ind_name,$ind_refs_values_pair);
                $this->em->persist($temp_ind);
                $this->addIndToTempByName($ind_name,$temp_ind);
            }
        }else{
            if($inds_in_bs==null || $inds_in_bs->count()==0){
                $temp_ind = $this->createNewInd($ind_name);
                $this->em->persist($temp_ind);
                $this->addIndToTempByName($ind_name,$temp_ind);
            }else{
                foreach ($inds_in_bs as $key => $ind) {
                    $this->addIndToTempByName($ind_name,$ind);
                }
            }
        }
        /*foreach ($missing_refs as $key => $ref_data) {
    		$ref_config = $ref_data['config'];
    		$ref_ind_set_method = $this->getRefIndSetMethod($ref_config);
    		$ref_values = $ref_data['value'];
    		$ref_values = is_array($ref_values) ? $ref_values : array($ref_values);
    		$ref_child = isset($ref_data['child_value']) ? $ref_data['child_value'] : null;
    		foreach ($ref_values as $key => $ref_value) {
    			$temp_ind = new $ind_class();
    			$temp_ind->$ref_ind_set_method($ref_value);
    			$temp_ind->setBilanSocialConsolide($this->getBs());
    			$temp_ind->setDtCrea($now);
        		$temp_ind->setCdUtilcrea($cd_util);
    			$this->em->persist($temp_ind);
    			$this->addIndToTempByName($ind_name,$temp_ind);
    		}
        }*/
    }
    private function getTypeForValueFrom($value_from){
        $from_type = null;
        if(is_array($value_from)){
            $from_type = $this->tryKeysOver('from_type',$value_from,self::FROM_INDICATEUR_PROPERTY);
        }
        else if(is_callable($value_from)){
            $from_type = self::FROM_CUSTOM_FUNCTION;
        }else{
            $from_type = self::FROM_INDICATEUR_PROPERTY;
        }
        return $from_type;
    }
    public function getValueFromInd($from_data,$from,$ind_name){
        $current_from = isset($from[0]) ? $from[0] : null;
        $current_data = $from_data;

        if($current_from!=null){
            $from_type = $this->getTypeForValueFrom($current_from);
            switch ($from_type) {
                case self::FROM_INDICATEUR_PROPERTY:
                    $get_method = 'get'.ucfirst($current_from);
                    if(method_exists($from_data,$get_method)){
                        $current_data = $from_data->$get_method();
                    }
                    break;
                case self::FROM_CUSTOM_FUNCTION:
                    $function = $this->tryKeysOver('from_function',$current_from,$current_from);
                    $current_data = is_callable($function) ? $function($ind_name,$from_data) : null;
                    break;
                case self::FROM_BUILD_IN_FUNCTION:
                    $from_name = $this->tryKeysOver('from_name',$current_from);
                    $from_params = $this->tryKeysOver('from_params',$current_from,array());
                    $function = $this->getBuildIndFunction($from_name);
                    $current_data = $function($from_data,$ind_name,$from_params);
                    break;
            }
            if($next_from = isset($from[1])){
                array_shift($from);
            }
            if($next_from){
                $current_data = $this->getValueFromInd($current_data,$from,$ind_name);
            }
        }
        return $current_data;
    }
    public function getIndPrintForData($ind_name,$ind_data,$print_for_to_process=null){
        //$print_for_to_process = $print_for_to_process==null ? $this->getIndPrintFor($ind_name) : $print_for_to_process;
        $print_for_to_process = $this->getIndPrintFor($ind_name);
        $ind_print_for_data = $this->getValueFromInd($ind_data,$print_for_to_process,$ind_name);
        return $ind_print_for_data;
       // $current_print_for = isset($print_for_to_process[0]) ? $print_for_to_process[0] : null;
        /*$current_obj_data = $print_for_to_process == null ? null : $obj_data;
        if($current_print_for!=null){
            $get_method = 'get'.ucfirst($current_print_for);
            if($next_print_for = isset($print_for_to_process[1])){
                array_shift($print_for_to_process);
            }

            if(method_exists($obj_data,$get_method)){
                $current_obj_data = $obj_data->$get_method();
                if($next_print_for){
                    $current_obj_data = $this->getPrintForData($ind_name,$current_obj_data,$print_for_to_process);
                }
            }
        }
        return $current_obj_data;*/
    }
    public function applyIndOnMove($ind_name,&$ind_data,$ind_temp_key){
        $on_move = $this->getIndOnMove($ind_name);
        foreach ($on_move as $key => $to_do) {
            $type = isset($to_do['type']) ? $to_do['type'] : null;
            switch ($type) {
                case self::ON_MOVE_SET_IND_FIELD :
                    $ind_field = isset($to_do['ind_field']) ? $to_do['ind_field'] : null;
                    $value_from = isset($to_do['value_from']) ? $to_do['value_from'] : null;
                    if($ind_field!=null && $value_from!=null){
                        $value_set_method = 'set'.ucfirst($ind_field);
                        $value_to_set = $this->getValueFromInd($ind_data,$value_from,$ind_name);
                        if(method_exists($ind_data,$value_set_method)){
                            $ind_data->$value_set_method($value_to_set);
                        }
                    }
                    break;
                case self::ON_MOVE_CUSTOM_FUNCTION :
                    $to_execute = $to_do['to_execute'];
                    if(is_callable($to_execute)){
                        $to_execute($ind_name,$ind_data,$ind_temp_key);
                    }
                default:
                    # code...
                    break;
            }
        }
    }
    public function applyIndAfterMove($ind_name){
        $on_move = $this->getIndAfterMove($ind_name);
        foreach ($on_move as $key => $to_do) {
            $type = isset($to_do['type']) ? $to_do['type'] : null;
            switch ($type) {
                case self::ON_EVENT_CUSTOM_FUNCTION :
                    $to_execute = $to_do['to_execute'];
                    if(is_callable($to_execute)){
                        $to_execute($ind_name);
                    }
                    break;
                case self::ON_EVENT_BUILD_IN_FUNCTION :
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
    public function groupByOrderTempIndContainer($ind_name){
        $ordered_temp_in_container = $this->processToOrderBy($ind_name);
        $this->resetTempIndContainer($ordered_temp_in_container);
        $ordered_temp_in_container = $this->processToGroupBy($ind_name);
        $this->resetTempIndContainer($ordered_temp_in_container);
        $ordered_temp_in_container = $this->processToMakeGroup($ind_name);
        $this->resetTempIndContainer($ordered_temp_in_container);
    }
    public function processToGroupBy($ind_name,$inds_to_group=null,$group_by_to_process=null){
        $group_by_to_process = $group_by_to_process!=null ? $group_by_to_process : $this->getIndGroupBy($ind_name);
        $inds_to_group = $inds_to_group!=null ? $inds_to_group : $this->getTempIndContainer();
        if($group_by_to_process!=null){
            $current_group_by = isset($group_by_to_process[0]) ? $group_by_to_process[0] : null;
            if($current_group_by!=null){
                if($next_group_by = isset($group_by_to_process[1])){
                    array_shift($group_by_to_process);
                }
                $in_order = array();
                $final = array();
                //$ind_in_temp = $this->getTempIndContainer();
                foreach ($inds_to_group as $key => $ind) {
                    $value_to_group_by = $this->getValueFromInd($ind,$current_group_by['value_from'],$ind_name);
                    if(!isset($in_order[$value_to_group_by])){
                        $in_order[$value_to_group_by]=array();
                    }
                    $in_order[$value_to_group_by][]=$ind;
                }
                foreach ($in_order as $group_key => $to_order) {
                    if($next_group_by){
                        $ordered = $this->processToGroupByGroup($ind_name,$to_order,$group_by_to_process);
                    }else{
                        $ordered = $to_order;
                    }
                    $final = array_merge($final,$ordered);
                }
                return $final;
            }
        }else{
             return $inds_to_group->toArray();
        }
    }
    public function processToOrderBy($ind_name){
        $inds_to_order = $this->getTempIndContainer();
        if($this->hasIndRefs($ind_name,self::REF_TYPE_DATABASE)){
            $nb_to_sort = count($inds_to_order);
            $sorted_pile = array();
            $working_pile = $inds_to_order;
            $current_ordre = 0;
            $cpt_sort = 0;
            $next_ordre = $current_ordre;
            $rest_not_sort = array();
            while ($nb_to_sort > $cpt_sort) {
                $current_ordre = $next_ordre;
                foreach ($inds_to_order as $key => $ind) {
                    $temp_ref = $this->getIndOneRefData($ind_name,$ind);
                    if($temp_ref!=null){
                        $ind_ordre = $temp_ref->getNmOrdre();
                        if(!in_array($ind,$sorted_pile)){
                            if($ind_ordre==$current_ordre){
                                $sorted_pile[]=$ind;
                                $cpt_sort++;
                            }else if($ind_ordre>$current_ordre && $ind_ordre<$next_ordre){
                                $next_ordre = $ind_ordre;
                            }
                        }
                    }else{
                        $rest_not_sort[]=$ind;
                        $cpt_sort++;
                        $next_ordre++;
                    }
                }
            }
            
            $sorted_pile = array_filter($sorted_pile);
            $sorted_pile = array_values($sorted_pile);
            $sorted_pile = array_merge($sorted_pile,$rest_not_sort);
            return $sorted_pile;
        }else{
            return $inds_to_order;
        }
    }
    public function processToMakeGroup($ind_name,$inds_to_group=null,$make_group_to_process=null,$group_iterator=0){
        $make_group_to_process = $make_group_to_process!=null ? $make_group_to_process : $this->getIndMakeGroup($ind_name);
        $inds_to_group = $inds_to_group!=null ? $inds_to_group : $this->getTempIndContainer();
        if($make_group_to_process!=null){
            $in_order = array();
            $nb_group = count($make_group_to_process);
            $cpt_group =0;
            foreach ($make_group_to_process as $group_key => $make_group_config) {
                if(!isset($in_order[$group_key])){
                    $in_order[$group_key]=array();
                }
                if($group_key==0) $inds_still_to_group = $inds_to_group;
                $value_to_seek = $make_group_config['value_to_seek'];
                $temp_still_to_group = array();
                foreach ($inds_still_to_group as $key => $ind) {
                    $value_to_compare = $this->getValueFromInd($ind,$make_group_config['value_from'],$ind_name);
                    if($value_to_compare===$value_to_seek || in_array($value_to_compare,$value_to_seek)){
                        $in_order[$group_key][] = $ind;
                    }else{
                        $temp_still_to_group[]=$ind;
                    }
                }
                $inds_still_to_group = $temp_still_to_group;
                $cpt_group++;
                if($nb_group<$cpt_group+1 && !empty($inds_still_to_group)){
                    $in_order[] = $inds_still_to_group;
                }
            }
            $final = array();
            foreach ($in_order as $group_key => $inds_group) {
                $final = array_merge($final,$inds_group);
            }
            return $final;
        }else{
            return $inds_to_group->toArray();
        }
    }
    public function moveIndToTemplateByName($ind_name,$print_for_value=null,$options=array()){
        return $this->moveIndTempToRealByName($ind_name,$print_for_value,$options);
    }
    public function moveIndTempToRealByName($ind_name,$print_for_value=null,$options=array()){
        //$bs_ind_temp_get_method = $this->getBsIndTempGetMethod($ind_name);
        extract($options);
        $force = isset($force) ? $force==true : false;
        $this->groupByOrderTempIndContainer($ind_name);
    	$temp_inds = $this->getTempIndContainer();//$this->getBs()->$bs_ind_temp_get_method();
    	$inds_to_print = new ArrayCollection();
        $has_print_condition = $this->getIndPrintFor($ind_name)!=null;
        $has_on_move = $this->getIndOnMove($ind_name)!=null;
        $has_after_move = $this->getIndAfterMove($ind_name)!=null;
        foreach ($temp_inds as $temp_ind_key => $temp_ind) {
            $value_to_compare = $this->getIndPrintForData($ind_name,$temp_ind);
            if($has_on_move){
                $this->applyIndOnMove($ind_name,$temp_ind,$temp_ind_key);
            }

            $to_print_ok = $force || !$has_print_condition || $value_to_compare==$print_for_value;
            if($to_print_ok){
                $inds_to_print->add($temp_ind);
            }
        }
        if($has_after_move){
            $this->applyIndAfterMove($ind_name);
        }
        //$this->setIndsByName($ind_name,$inds_to_print);
        $bs_ind_temp_set_method = $this->getBsIndTempSetMethod($ind_name);
        if(method_exists($this->getBs(),$bs_ind_temp_set_method)){
            $clone_inds = clone $inds_to_print;
            $this->getBs()->$bs_ind_temp_set_method($clone_inds);//new ArrayCollection($inds_to_print));
        }
    	return $this->em;
    }

    /*
    *	fonction utilitaire
    */
    public function isCollection($var){
    	$is_collection = false;
    	if($var != null){
    		$interfaces = \class_implements($var);
    		$is_collection = isset($interfaces['Collection']) || isset($interfaces['Doctrine\Common\Collections\Collection']);
    	}
    	return $is_collection;
    }

    public function tryKeysOver($keys,$over,$default=null){
        $keys = is_array($keys) ? $keys : array($keys);
        $result = $default;
        if(is_array($over)){
            foreach ($keys as $i => $key) {

                if(isset($over[$key])){
                    $result = $over[$key];
                    break;
                }
            }
        }
        return $result;
    }

    public function getIndFieldGetMethod($field_name, $obj = null) {
        $field_get_method = "get" . ucfirst($field_name);
        if ($obj != null) {
            $field_get_method = method_exists($obj, $field_get_method) ? $field_get_method : null;
        }
        return $field_get_method;
    }

    public function array_merge_unique($arr1,$arr2){
        $merged_array = array_merge($arr1, $arr2);
       
        $unique_array =  array();
        foreach($merged_array as $k => $v){
            if(!in_array($v,$unique_array)){
                if(is_numeric($k)){
                    $unique_array[] = $v;
                }else{
                    $unique_array[$k] = $v;
                }
                
            }
        }
        return $unique_array;//array_unique(array_merge($arr1, $arr2),SORT_REGULAR);
    }
}
