var DEFAULT = "hide_and_show_default_for_condition";
config = {
    bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112: [
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                "#agent_remunere",
                "#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112no",
                "#yesPartiTemp",
                "#infotextTemp",
                "blEmplfoncno",
            ]
        },
        {
            // si question Q4.1 - Agent rémunéré au 31/12 ? = non donc afficher q4.2
            condition: ":current_value === 0",
            to_show: [
                "#agent_remunere",
                "#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112no",

            ],
            to_hide: [ 
                "#yesPartiTemp",
                "#infotextTemp",
                "#blEmplfoncno",
            ]
        },
        {
            condition:  ":current_value === 1",
            to_show: [
                "#blEmplfoncno",
            ],
            to_hide: [
                ['#agent_remunere', '#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112no']
            ]
        },
        
        {
            condition:  ":current_value === 2",
            to_show: [
                "#infotextTemp",
            ],
            to_hide: ['#agent_remunere', '#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112no']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blAgenremuanne: [
        {
            //si question Q4.2 - Agent rémunéré au moins une fois dans l'année? = non donc afficher q2.7
            condition: ":current_value === 0 && :current_value !== ''",
            to_show: [
                "#Agenremuanne"
            ],
            to_hide: ['#q42Non']
        },
        {
            condition: DEFAULT,
            to_show: ['#q42Non'],
            to_hide: [
                "#Agenremuanne"
            ]
        }
    ],
//    bilan_social_bundle_apabundle_bilansocialagent_blTempcomp: [
//        {
//            //si question Q11.1 - L'agent est-il à temps complet ? = non donc afficher q12.1
//            condition: ":current_value === 0",
//            to_show: [
//                "#q11non"
//            ],
//            to_hide: []
//        },
//        {
//            condition: DEFAULT,
//            to_show: [],
//            to_hide: [
//                "#q11non"
//            ]
//        }
//    ],
    bilan_social_bundle_apabundle_bilansocialagent_blPosiacti: [
        {
            //si question Q2.7 -Quel est votre position statutaire au 31/12 ? != activité alors => Particuliere
            // alors affiché bouton pour laisser le choix de ne pas enregistrer l'agent
            condition: ":current_value === 0 && :current_value !== '' && :current_value != null",
            to_show: [
                "#particuliere"
            ],
            to_hide: []
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                "#particuliere"
            ]
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blPosiactinonremu: [
        {
            //si question Q2.7 -Quel est votre position statutaire au 31/12 ? != activité alors => Particuliere
            // alors affiché bouton pour laisser le choix de ne pas enregistrer l'agent
            condition: ":current_value === 0 && :current_value !== ''",
            to_show: [
                "#particuliereNonRemu"
            ],
            to_hide: []
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                "#particuliereNonRemu"
            ]
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_refStatut: [
        {
            //Q2 - Quel est son dernier statut connu au plus tard au 31/12 ?
            /*
             * affiche en meme temps la Q18 - L'agent a-t-il eu une promotion, un avancement ou une mise en stage suite à un concours au cours de l'année ?
             * qui n'est disponible que pour ces 2 statuts
             */
            condition: ":current_value === 1 || :current_value === 2",
            to_show: [
                "#stagtituPerm", '#blPromavanstaganne', '#stagtitu', "#cet", '#mtTotaremubrutnbi', '#EmploiPermanent', '#EmploiPermanent2', '#grade_emploi_perm', '#emplFonc', '#categ', '#emplPerm1', '#emplPerm2'
            ],
            to_hide: [
                '#nonPermanent', '#permanent', '#perm','#horsFili'
            ]
        },
        {
            condition: ":current_value === 3",
            to_show: [
                "#stagtituPerm", "#cet", '#permanent', '#perm', '#EmploiPermanent2', '#stagtitu', '#emplFonc', '#categ', '#emplPerm1', '#emplPerm2'
            ],
            to_hide: [
                '#blPromavanstaganne', '#nonPermanent', '#mtTotaremubrutnbi', '#EmploiPermanent', '#grade_emploi_perm','#horsFili'
            ]
        },
        {
            condition: ":current_value === 4",
            to_show: [
                '#nonPermanent', '#EmploiPermanent', '#EmploiPermanent2','#horsFili'
            ],
            to_hide: [
                '#blPromavanstaganne', "#cet", "#stagtituPerm", '#stagtitu', '#permanent', '#perm', '#mtTotaremubrutnbi', '#emplFonc', '#categ', '#emplPerm1', '#emplPerm2'
            ]
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                '#blPromavanstaganne', "#cet", "#stagtituPerm", '#permanent', '#perm', '#emplFonc', '#categ', '#emplPerm1', '#emplPerm2', '#nonPermanent', '#stagtitu', '#mtTotaremubrutnbi',"#EmploiPermanent", "#EmploiPermanent2",'#horsFili'
            ]
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blAgenabse: [
        {
            /*
             * Q5.1 - L'agent est-il arrivé dans l'année du BS dans la collectivité ?
             *
             *  Si oui est sélectionné alors afficher q5.4
             */
            condition: ":current_value === 1",
            to_show: ['#AbsenceArret','#DgclJoursCarence'],
            to_hide: []
        },
        {
            condition: ":current_value === 0 || :current_value === ''",
            to_show: [],
            to_hide: ['#AbsenceArret','#DgclJoursCarence']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                '#AbsenceArret',
                '#DgclJoursCarence'
            ]
        }

    ],
    bilan_social_bundle_apabundle_bilansocialagent_Dgcl_blJoursCarence: [
        {
            /*
             * Q5.1 - L'agent est-il arrivé dans l'année du BS dans la collectivité ?
             *
             *  Si oui est sélectionné alors afficher q5.4
             */
            condition: ":current_value === 1",
            to_show: ['#DgclJoursCarenceDetails'],
            to_hide: []
        },
        {
            condition: ":current_value === 0 || :current_value === ''",
            to_show: [],
            to_hide: ['#DgclJoursCarenceDetails']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                '#DgclJoursCarenceDetails',
            ]
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blFormsuiv: [
        {
            /*
             * Q5.1 - L'agent est-il arrivé dans l'année du BS dans la collectivité ?
             *
             *  Si oui est sélectionné alors afficher q5.4
             */
            condition: ":current_value === 1",
            to_show: ['#FormationAgent'],
            to_hide: []
        },
        {
            condition: ":current_value === 0 || :current_value === ''",
            to_show: [],
            to_hide: ['#FormationAgent']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                '#FormationAgent',
            ]
        }
    ],

    bilan_social_bundle_apabundle_bilansocialagent_blAgenarriannecoll: [
        {
            condition: ":current_value === 1",
            to_show: ['#refMotifArrivee','#EmploiPermanent'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#refMotifArrivee','#EmploiPermanent']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                '#refMotifArrivee','#EmploiPermanent'
            ]
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blEmplfonc: [
        {
            /*
             * Q8.1 - A t'il occupé un emploi fonctionnel ? Si oui de quoi est-il détaché ?
             *
             * si oui afficher q8.2 / q8.2.1 / q8.3 / q8.4
             *
             * si non afficher q2.7
             */

            condition: ":current_value === 1",
            to_show: [
                '#blEmplfoncyes',
                '#graddeta'
            ],
            to_hide: ['#blEmplfoncno']
        },
        {
            condition: ":current_value === 0",
            to_show: ['#blEmplfoncno'],
            to_hide: ['#blEmplfoncyes', '#graddeta']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: [
                '#blEmplfoncyes','#graddeta', '#blEmplfoncno',
            ]
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_refFonctionPublique: [
        {
            /*
             * Q8.2 - De quelle fonction publique est-il détaché ?
             * Si reponse = FPE ou FPH alors affiché Q2.8
             */

            condition: ":current_value === 2 || :current_value === 3",
            to_show: ['#fonctionpublique'],
            to_hide: []
        },
        {
            condition: ":current_value !== 2 && :current_value !== 3  ",
            to_show: [],
            to_hide: ['#fonctionpublique']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: ['#fonctionpublique']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blAcqustatanne: [
        {
            /*
             * Q2.0 - Si reponse = Oui alors afficher Q17
             */

            condition: ":current_value === 1",
            to_show: ['#blAcqustatanne'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blAcqustatanne']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: ['#blAcqustatanne']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blAgentitustaganne: [
        {
            /*
             * Q17 - L'agent a-t-il été titularisé ou mise en stage au cours de l'année ?
             * si reponse = oui alors affiché Q17.1
             */

            condition: ":current_value === 1",
            to_show: ['#blAgentitustaganne'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blAgentitustaganne']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: ['#blAgentitustaganne']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blPromavanstaganne: [
        {
            /*
             * Q18.1
             */

            condition: ":current_value === 1",
            to_show: ['#blPromavanstaganneyes'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blPromavanstaganneyes']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: ['#blPromavanstaganneyes']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blTempcomp: [
        {
            /*
             * Q11.1
             */

            condition: ":current_value === 0",
            to_show: ['#refTempsNonComplet'],
            to_hide: ['#q11non']
        },
        {
            condition: ":current_value === 1",
            to_show: ['#q11non'],
            to_hide: ['#refTempsNonComplet']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: ['#refTempsNonComplet', '#q11non']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blTempplein: [
        {
            /*
             * Q12.1
             */

            condition: ":current_value === 0",
            to_show: ['#refTempsPartiel'],
            to_hide: []
        },
        {
            condition: ":current_value !== 0",
            to_show: [],
            to_hide: ['#refTempsPartiel']
        },
        {
            condition: DEFAULT,
            to_show: [],
            to_hide: ['#refTempsPartiel']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blDemapart: [
        {
            /*
             * Q28
             */

            condition: ":current_value == 1",
            to_show: ['#Demapart'],
            to_hide: []
        },
        {
            condition: ":current_value === undefined || :current_value !== 1",
            to_show: [],
            to_hide: ['#Demapart']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blCdi: [
        {
            /*
             * emploi non permanent = oui
             * Q2.1
             */

            condition: ":current_value === 0",
            to_show: ['#refTypeCdd'],
            to_hide: []
        },
        {
            condition: ":current_value !== 0",
            to_show: [],
            to_hide: ['#refTypeCdd']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_refEmploiNonPermanent: [
        {
            /*
             * emploi non permanent = oui
             * Q2.6
             */

            condition: ":current_value === 1",
            to_show: ['#refEmploiNonPermanent'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#refEmploiNonPermanent']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blEntrretocong: [
        {
            /*
             * Q23 et Q23.1
             */

            condition: ":current_value === 1",
            to_show: ['#blEntrretocong'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blEntrretocong']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blEntrdepacong: [
        {
            /*
             * Q22 et Q22.1
             */

            condition: ":current_value === 1",
            to_show: ['#blEntrdepacong'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blEntrdepacong']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blVae: [
        {
            /*
             * Q34.1 et Q34.2
             */

            condition: ":current_value === 1",
            to_show: ['#bilan_social_bundle_apabundle_bilansocialagent_blVaeyes'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#bilan_social_bundle_apabundle_bilansocialagent_blVaeyes']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blBilacomp: [
        {
            /*
             * Q34.1 et Q34.2
             */

            condition: ":current_value === 1",
            to_show: ['#bilan_social_bundle_apabundle_bilansocialagent_blBilacompyes'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#bilan_social_bundle_apabundle_bilansocialagent_blBilacompyes']
        }
    ],
    /*bilan_social_bundle_apabundle_bilansocialagent_blCongpateaccuenfa: [
        {
            //
            // Q34.1 et Q34.2
            ///

            condition: ":current_value === 1",
            to_show: ['#congepatea'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#congepatea']
        }
    ],
        */
    bilan_social_bundle_apabundle_bilansocialagent_blDemainap: [
        {
            /*
             * Q32.1 - Est-ce que l'agent a fait une demande de reclassement au cours de l'année ? (Si oui L 15/16)
             */

            condition: ":current_value === 1",
            to_show: ['#inapdema'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#inapdema']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blHeureSuppComp: [
        {
            /*
             * Cet agent est-il concerné par les heures supplémentaires ou complémentaires ?
             */

            condition: ":current_value === 1",
            to_show: ['#nbHeureSupp', '#nbHeureComp'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#nbHeureSupp', '#nbHeureComp']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blDeciinap: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":current_value === 1",
            to_show: ['#inapdeci'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#inapdeci']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blDocurisqpro: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":current_value === 1",
            to_show: ['#blDocurisqpro'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blDocurisqpro']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blActeviolphys: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":current_value === 1",
            to_show: ['#blActeviolphys'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blActeviolphys']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_q432: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":current_value === 1",
            to_show: ['#blq432'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blq432']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_q433: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":current_value === 1",
            to_show: ['#blq433'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blq433']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blGrev: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":current_value === 1",
            to_show: ['#blGrev'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blGrev']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blCtsiegmissdevo: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":current_value === 1",
            to_show: ['#blCtsiegmissdevo'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#blCtsiegmissdevo']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blAutrgardenfa: [
        {

            condition: ":to_check_0 === 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blAutrgardenfa'
            ],
            to_show: ['#blAutrgardenfaDescription'],
            to_hide: [],
        },
        {
            condition: ":to_check_0 !== 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blAutrgardenfa'
            ],
            to_show: [],
            to_hide: ['#blAutrgardenfaDescription']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blSantcontregl: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":to_check_0 === 1 || :to_check_1 === 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantcontregl'
            ],
            to_show: ['#blSantyes'],
            to_hide: [],
        },
        {
            condition: ":to_check_0 !== 1 && :to_check_1 !== 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantcontregl'
            ],
            to_show: [],
            to_hide: ['#blSantyes']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blSantconvparti: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":to_check_0 === 1 || :to_check_1 === 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantcontregl'
            ],
            to_show: ['#blSantyes'],
            to_hide: [],
        },
        {
            condition: ":to_check_0 !== 1 && :to_check_1 !== 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blSantcontregl'
            ],
            to_show: [],
            to_hide: ['#blSantyes']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevoconvparti: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":to_check_0 === 1 || :to_check_1 === 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevoconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevocontregl'
            ],
            to_show: ['#blPrevyes'],
            to_hide: [],
        },
        {
            condition: ":to_check_0 !== 1 && :to_check_1 !== 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevoconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevocontregl'
            ],
            to_show: [],
            to_hide: ['#blPrevyes']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevocontregl: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: ":to_check_0 === 1 || :to_check_1 === 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevoconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevocontregl'
            ],
            to_show: ['#blPrevyes'],
            to_hide: [],
        },
        {
            condition: ":to_check_0 !== 1 && :to_check_1 !== 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevoconvparti',
                'bilan_social_bundle_apabundle_informationcolectiviteagent_blPrevocontregl'
            ],
            to_show: [],
            to_hide: ['#blPrevyes']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blCet: [
        {
            /*
             * Q26 -
             */

            condition: ":to_check_0 === 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_bilansocialagent_blCet',
            ],
            to_show: ['#blCetyes'],
            to_hide: [],
        },
        {
            condition: ":to_check_0 !== 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_bilansocialagent_blCet',
            ],
            to_show: [],
            to_hide: ['#blCetyes']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blTeletrav: [
        {
            /*
             * Q27 -
             */

            condition: ":current_value === 1",
            to_show: ['#afficher271'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#afficher271']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blAgenprev: [
        {
            /*
             * Q26 -
             */

            condition: ":to_check_0 === 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_bilansocialagent_blAgenprev',
            ],
            to_show: ['#blAgenprevyes'],
            to_hide: [],
        },
        {
            condition: ":to_check_0 !== 1",
            ids_to_check: [
                'bilan_social_bundle_apabundle_bilansocialagent_blAgenprev',
            ],
            to_show: [],
            to_hide: ['#blAgenprevyes']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_blRecPersTemp: [
        {
            // 1 3 2 - Information collectivité agent

            condition: ":current_value === 1",
            to_show: ['#infocoll132'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#infocoll132']
        }
    ],
    bilan_social_bundle_apabundle_informationgenerale_q1: [
        {
            // 1 3 2 - Information collectivité agent

            condition: ":current_value === 0",
            to_show: ['#q1'],
            to_hide: []
        },
        {
            condition: ":current_value !== 0",
            to_show: [],
            to_hide: ['#q1']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_blBoeth: [
        {
            // handitorial formulaire apres q19 dans absence
            condition: ":current_value === 1",
            to_show: ['.handitorial_boeth'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['.handitorial_boeth']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_Handitorials_blAvisInaptitudeEnCours: [
        {
            // inaptitude si handitorial inaptitude en cours = oui dans absence
            condition: ":current_value === 1",
            to_show: ['#b2_2'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#b2_2']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_Handitorials_blAvisInaptitudeAvant: [
        {
            // mesure absence si handitorial inaptitude avant = oui dans absence
            condition: ":current_value === 1",
            to_show: ['#b2_3'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#b2_3']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_handNbReclaDemande: [
        {
            condition: ":current_value != null",
            to_show: ['#A5-2-0'],
            to_hide: []
        },
        {
            condition: ":current_value == null",
            to_show: [],
            to_hide: ['#A5-2-0']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_handNbRecla: [
        {
            condition: ":current_value != null",
            to_show: ['#A5-2-1'],
            to_hide: []
        },
        {
            condition: ":current_value == null",
            to_show: [],
            to_hide: ['#A5-2-1']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_handDispoOffice: [
        {
            condition: ":current_value === 1",
            to_show: ['#A8'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#A8']
        }
    ],
    bilan_social_bundle_apabundle_bilansocialagent_refTypeCdd: [
        {
            condition: ":current_value == 8 ",
            to_show: ['#refMotifArrivee'],
            to_hide: []
        },
        {
            condition: ":current_value !== 8",
            to_show: [],
            to_hide: ['#refMotifArrivee']
        }
    ],
    bilan_social_bundle_apabundle_informationcolectiviteagent_r2103: [
        {
            // 2.1.0 - Nombre de journées de congés supplémentaires

            condition: ":current_value === 1",
            to_show: ['#afficheR1204'],
            to_hide: []
        },
        {
            condition: ":current_value !== 1",
            to_show: [],
            to_hide: ['#afficheR1204']
        }
    ],
     bilan_social_bundle_apabundle_bilansocialagent_refMotifArrivee: [
        {
            /*
             * Q32.2 -Est-ce qu'il y a une décision d'inaptitude ? (Si oui => 18,19,20,21,32,33,34)
             */

            condition: "(:to_check_0 !== 12 || :to_check_0 !== 14) && (:to_check_1 !== 1 || :to_check_1 !== 2)",
            ids_to_check: [
                'bilan_social_bundle_apabundle_bilansocialagent_refMotifArrivee',
                'bilan_social_bundle_apabundle_bilansocialagent_refStatut'
            ],
            to_show: ['#motiArrietStat'],
            to_hide: [],
        },
        {
            condition: "(:to_check_0 === 12 || :to_check_0 === 14) && (:to_check_1 === 1 || :to_check_1 === 2)",
            ids_to_check: [
                'bilan_social_bundle_apabundle_bilansocialagent_refMotifArrivee',
                'bilan_social_bundle_apabundle_bilansocialagent_refStatut'
            ],
            to_show: [],
            to_hide: ['#motiArrietStat']
        }
    ],
};


$(document).ready(function () {
    /* Function permetant de re afficher les champs a partir de la q2 ( ref statut ) dans le cas ou la question q4.1 était a non puis changé a oui ou oui mais parti temporairement */
    $('#bilan_social_bundle_apabundle_bilansocialagent_blAgenremu3112').on('change', function(){
       var value = $(this).find('input[type="radio"]:checked').val();

       if(value == 1 || value == 2){
           var input_to_unchecked = $('#bilan_social_bundle_apabundle_bilansocialagent_blAgenremuanne').find('input[type="radio"]:checked');
           input_to_unchecked.prop('checked', false);
           var input_to_unchecked1 = $('#bilan_social_bundle_apabundle_bilansocialagent_blPosiactinonremu').find('input[type="radio"]:checked');
           input_to_unchecked1.prop('checked', false);
           input_to_unchecked1.change();
           input_to_unchecked.change();
       }
    });

    setChangeEvent();
    tagHiddenQ();
    refreshPanelPourcentage();
});
$(document).on('change', function(){
    refreshPanelPourcentage();
});

$(document).on('change', 'table', function(){
       refreshPanelPourcentage();
});
$(document).on('click', '.remove', function(){
       refreshPanelPourcentage();
});


function setChangeEvent() {
    for (id_input in config) {
        var evenenement = 'change';
        var input = getInputFromId(id_input);
        $(input).addClass('qcondition');
        if (id_input === 'bilan_social_bundle_apabundle_bilansocialagent_nbDemapart') {
            evenenement = "keyup";
        }
        $(input).on(evenenement, inputChanged);
    }
    $('.panel-body.apa :input:not(.qcondition)').on('change',function(event){
        refreshPanelPourcentage()
    })
}
function inputChanged(event) {
    saveScrollTop();
    var id_input = getIdFromInput(this);
    var conditions = getConditionsForInput(id_input);
    var current_value = getValueFromInput(this);
    var do_default = true;

    conditions.forEach(function (condition, index) {

        var condition_ok = false;
        var str_condition = condition.condition;
        var condition_is_multiple = condition.ids_to_check != undefined;
        if (str_condition != DEFAULT) {
            var preproc_condition;
            if (!condition_is_multiple) {
                preproc_condition = getPreProcCondition(str_condition, current_value);
            } else {
                preproc_condition = getPreProcMultiCondition(str_condition, condition.ids_to_check)
            }

            condition_ok = eval(preproc_condition);
            do_default = do_default && condition_ok ? false : do_default;
        } else if (do_default) {
            condition_ok = true;
        }
        if (condition_ok) {
            var to_hide = condition.to_hide;
            var to_show = condition.to_show;
            hideElements(to_hide);
//            console.log(to_hide);
            showElements(to_show);
        }

    });
    if (event.originalEvent !== undefined) {
        refreshPanelPourcentage()
    }
    resetScrollTop();
}

function getIdFromInput(input) {
    var id_input = undefined;
    if (input != undefined) {
        if ($(input).is('input')) {
            if ($(input).is(':radio')) {
                var wrapper = $(input).parents('.radio:first');
                id_input = $(wrapper).parent('div').attr('id');
            } else {
                id_input = $(input).attr('id');
            }
        } else if ($(input).is('select')) {
            id_input = $(input).attr('id');
        }
    }
    return id_input;
}
function getInputFromId(id_input) {
    var input = undefined;
    if (id_input != undefined) {
        input = $('#' + id_input);
        if (!$(input).is('input') && !$(input).is('select')) {
            input = $(input).find('input');
        }
    }
    return input;
}
function getValueFromInput(input) {
    var value = undefined;
    var input = $(input);
    if ($(input).is(':radio')) {
        $.each(input,function(index,element){
           if ($(element).prop('checked') === true) {
                value = $(element).val();
                return false;
            }
            else {
                value = undefined;
            }
        });
    } else {
        value = $(input).val();
    }
    return value = value != "" ? value : undefined;
}
function getValueFromId(id_input) {
    var input = getInputFromId(id_input);
    return getValueFromInput(input);
}
function getConditionsForInput(id_input) {
    return config[id_input];
}
function getPreProcCondition(condition, current_value) {
    var preproc_condition = condition.replace(/:current_value/g, current_value);
    return preproc_condition;
}
function getPreProcMultiCondition(condition, ids_to_check) {
    var preproc_condition = condition;
    var nb_to_check = ids_to_check.length
    for (var i = 0; i < nb_to_check; i++) {
        var temp_id_input = ids_to_check[i];
        var temp_value = getValueFromId(temp_id_input);
        //temp_value = temp_value != undefined ? temp_value : "";
        var placeholder = ":to_check_" + i;
        placeholder = new RegExp(placeholder, 'g');

        var preproc_condition = preproc_condition.replace(placeholder, temp_value);
    }

    return preproc_condition;
}
function hideElements(to_hide) {
    to_hide.forEach(function (element, index) {
        $(element).addClass('hidden');
        resetElement(element);
        tagHiddenQ();
    });
}
function showElements(to_show) {
    to_show.forEach(function (element, index) {
        untagHiddenQ(element);
        $(element).removeClass('hidden');
    });
}

function untagHiddenQ(element){
    var AllElementToClear = $(element).find(':input:hidden,table:hidden');

    $(AllElementToClear).each(function(){
        $(this).parents('.form-group:first').removeClass('qhidden');
        $(this).filter('table').removeClass('qhidden');
    });
}
function tagHiddenQ(){
    var parent = $('.panel-body.apa');

    $(parent).each(function(index,panel){
        var is_hidden = $(this).is(':hidden');
        var panel_name = $(this).parents('.panel:first').parent('section').attr('id');
        if(is_hidden) _toggleTabById(panel_name);//$(this).parents('.panel:first').parent('section').show();
        var AllElementToTag = $(panel).find(':input:hidden,table:hidden,.hidden');
        if(is_hidden) _toggleTabById(panel_name);//$(this).parents('.panel:first').parent('section').hide();
        $(AllElementToTag).each(function(){
            $(this).parents('.form-group:first').addClass('qhidden');
            $(this).filter('table').addClass('qhidden');
        });
    })

}

function calculPourc(){
    var sections = $('#wizard').children('section');
    var pourcentage = {};
    var pourcentage_agent = 0;

    $(sections).each(function(index,section){
        var panel_name = $(section).attr('id');
        var panels = $(section).find('.panel-body.apa');
        var nb_total = 0;
        var nb_valid = 0;

        $(panels).each(function(index,panel){
            var panel_form_group = $(panel).find('.form-group:not(.qhidden)');
            var table_form_group = $(panel).find('table.countforpc:not(.qhidden)');
            var inputs_wrappers = $.merge(panel_form_group,table_form_group);
            nb_total+=$(inputs_wrappers).length;
            
            var radio_names = [];
            var table = $(panel).find('table:not(.qhidden):not(.countforpc)');
            var test_remplie = true;
            
            $(table).each(function(index, element){
                var dtTable = false;
                if ( $.fn.DataTable.isDataTable( element ) ) {
                    nb_total++;
                    dtTable = true;
                    var tr = $(element).dataTable().$('tr', {"filter":"applied"});
                }else{
                    dtTable = false;
                    var tr = $(element).find('tbody tr');
                    if($(tr).length==0){
                        nb_total++;
                    }
                }
                    $(tr).each(function(index,ln){
                        if(dtTable == false){
                            nb_total++ ;
                        }
                        var input_enable = $(ln).find('input:not([disabled]), select:not([disabled])');

                        $(input_enable).each(function(index, inputs){
                            if(dtTable == true){
                               if($(inputs).attr('checked') === 'checked'){
                                   nb_valid++;
                                   return false;
                               }
                            }else{
                                var input_value = getValueFromInput(inputs);
                                if(isEmpty(input_value)){
                                    test_remplie = false;
                                    return false;
                                }
                            }
                          
                        });
                        if(dtTable == false){
                            if(test_remplie == true){
                                nb_valid++;
                            }   
                        }
                        
                    });
             });
            $(inputs_wrappers).each(function(index,element){
                var inputs = $(element).find(':input, select');

                var input_name = $(inputs).attr('name');
                var input_ok = false;
                if(!$.isArray(input_name,radio_names)){
                     var input_value = getValueFromInput(inputs);
                     if(!isEmpty(input_value)){
                         nb_valid++;
                         input_ok=true;
                     }
                }
                if($(inputs).is(':radio,:checkbox') && !$.isArray(input_name,radio_names) && input_ok){
                    radio_names.push(input_name);
                }

            });
//                           
        });
        
        pourcentage[panel_name] = nb_total>0 ? nb_valid / nb_total * 100 : 0;
    });
    pourcentage['rassct']=calcPourcRassct('rassct',sections);
    pourcentage['hand']=calcPourcHanditorial('hand', '#handitorial');
    pourcentage['dgcl']=calcPourcDgcl('dgcl', sections);


    var pc_temp_pourcentage_agent = $('.onglet');
    $(pc_temp_pourcentage_agent).each(function(index,element){
        pourcentage_agent += parseInt($(element).text().slice(0,-1));
//        console.log(pourcentage_agent);
    });

    $('#bilan_social_bundle_apabundle_bilansocialagent_pcFillAgent').val((pourcentage_agent/pc_temp_pourcentage_agent.length).toFixed(0));

    return pourcentage;
}

function calcPourcHanditorial(class_to_find,root_element){
    if(isset(informations_generales) && informations_generales['q3']==false){
        return 100;
    }else{
        var panel_form_group = $(root_element).find('.form-group:not(.qhidden)');
        var class_inputs = $(panel_form_group).find('.hand').not('.qhidden');
        var nb_class_total = $(class_inputs).length;
        var nb_class_valid = 0;
        var radio_names = [];
        var input_ok = "";
        $(class_inputs).each(function(index,input){
    //        console.log(input);
            var input_value = getValueFromInput(input);
            if($(input).is('div')){
                var div_input_child = $(this).find('input:checked');
                if(div_input_child.length > 0){
                    nb_class_valid++;
                }
            }
            var input_name = $(input).attr('name');
            if(!$.isArray(input_name,radio_names)){
                if(!isEmpty(input_value)){
                    nb_class_valid++;
                    input_ok=true;
                }
            }
            if($(input).is(':radio,:checkbox') && !$.isArray(input_name,radio_names) && input_ok){
                radio_names.push(input_name);
            }
        });
        return nb_class_total>0 ? nb_class_valid / nb_class_total * 100 : 0;
    }
}
function calcPourcRassct(class_to_find,root_element){
    root_element = isset(root_element) ? root_element : $('.panel-body.apa');
    var class_inputs = $(root_element).find('.'+class_to_find+'').not('.qhidden');
    var class_inputs_disabled = $(root_element).find(':input.'+class_to_find+':disabled:not(.qhidden)');
    /* gestion des cas ou q20.1 est a non ou si tout les champs d'une ligne sont disabled pour mettre a 100 % dans les deux cas */
    var q20_1 = undefined;

    if($('#bilan_social_bundle_apabundle_bilansocialagent_blAgenabse_1').prop('checked') === true){
        q20_1 = false;
    }else if(class_inputs.length == 0 || ((class_inputs.length > 0) && (class_inputs_disabled.length > 0) && (class_inputs.length === class_inputs_disabled.length))){
         q20_1 = false;
    }
    if(q20_1 === false){
         return 1 / 1 * 100;
    }
    var class_inputs_enabled = $(root_element).find(':input.'+class_to_find+':enabled:not(.qhidden)');
    var nb_class_valid = 0;
    $(class_inputs_enabled).each(function(index,input){
        var input_value = $(input).val();
            if(input_value !== undefined && input_value !== ""){
                nb_class_valid++;
            }
        });
    return class_inputs_enabled.length>0 ? nb_class_valid / class_inputs_enabled.length * 100 : 0;
}
function calcPourcDgcl(class_to_find,root_element){
    root_element = isset(root_element) ? root_element : $('.panel-body.apa');
    var class_inputs = $(root_element).find('.form-group:not(.qhidden) .'+class_to_find+'').not('.qhidden');
    var class_inputs_disabled = $(class_inputs).find(':input.'+class_to_find+':disabled:not(.qhidden)');
    class_inputs_disabled = $(class_inputs_disabled).add($(class_inputs).find(':input.'+class_to_find+':disabled:not(.qhidden)'));
    /* gestion des cas ou q20.1 est a non ou si tout les champs d'une ligne sont disabled pour mettre a 100 % dans les deux cas */
    var q20_1 = undefined;

    if($('#bilan_social_bundle_apabundle_bilansocialagent_blAgenabse_1').prop('checked') === true){
        q20_1 = false;
    }else if(class_inputs.length == 0 || ((class_inputs.length > 0) && (class_inputs_disabled.length > 0) && (class_inputs.length === class_inputs_disabled.length))){
         q20_1 = false;
    }
    if(q20_1 === false){
         return 1 / 1 * 100;
    }
    var class_inputs_enabled = $(class_inputs).find(':input:enabled:not(.qhidden)');
    class_inputs_enabled = $(class_inputs_enabled).add($(class_inputs).filter(':input:enabled:not(.qhidden)'));
    var nb_class_valid = 0;
    var nb_radio_over = 0;
    var radio_names = [];
    var input_ok = false;
    $(class_inputs_enabled).each(function(index,input){
        input_ok = false;
        var input_name = $(input).attr('name');
        if(!$.isArray(input_name,radio_names)){
             var input_value = getValueFromInput(input);
             if(!isEmpty(input_value)){
                 nb_class_valid++;
                 
                 input_ok = true;
             }else if($(input).is('[type="radio"]')){
                nb_radio_over++;
            }
        }else{
            nb_radio_over++;
        }
        if($(input).is(':radio,:checkbox') && !$.isArray(input_name,radio_names) && input_ok){
            radio_names.push(input_name);
        }      
    });
    var real_nb_input = class_inputs_enabled.length - nb_radio_over;
    return real_nb_input>0 ? nb_class_valid / real_nb_input * 100 : 0;
}
function refreshPanelPourcentage(){
    var pourcentages = calculPourc();
    for(panel_id in pourcentages){
        var pourc = pourcentages[panel_id];
        _setPanelPourcentage(panel_id,pourc);
    }
}
function resetElement(element){
    var AllElementToClear = $(element + ' :input');
    var has_been_done=[];
    $(AllElementToClear).each(function(){
        var may_has_condition = undefined;
        if ($(this).is('input')) {
            if ($(this).is(':radio')) {
              $(this).prop('checked', false);
              may_has_condition = $(this).parents('.radio').parent();
            }else if($(this).is(':checkbox')){
                $(this).prop('checked',false);
                may_has_condition = $(this);
            }else {
                $(this).val('');
                may_has_condition = $(this);
            }
        } else if ($(this).is('select')) {
            $(this).val('-1');
            may_has_condition = $(this);
        }
         if(hasHideAndShowCondition(may_has_condition)){
            $(this).trigger('change', true);
            has_been_done.push(may_has_condition);
        }
    });
}

function hasHideAndShowCondition(element){
    var element_id = $(element).attr('id');
    return config[element_id]!=undefined;
}

$('form').on('submit', function(e){
    calculPourc();
    refreshPanelPourcentage();
});
