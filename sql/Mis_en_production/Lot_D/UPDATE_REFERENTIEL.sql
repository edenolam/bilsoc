/* Mise à jour du code N4DS pour récupérer l'emploi fonctionnel */
UPDATE ref_emploi_fonctionnel SET CD_MOTI_N4DS = 'BAU2-EAU2-HAU2-MAU2-TAU2' WHERE CD_EMPLFONC = 'EF001';
UPDATE ref_emploi_fonctionnel SET CD_MOTI_N4DS = 'BAU1-EAU1-HAU1-MAU1-TAU1' WHERE CD_EMPLFONC = 'EF002';
UPDATE ref_emploi_fonctionnel SET CD_MOTI_N4DS = 'BTU2-ETU2-HTU2-MTU2-TTU2' WHERE CD_EMPLFONC = 'EF003';
UPDATE ref_emploi_fonctionnel SET CD_MOTI_N4DS = 'BTU1-ETU1-HTU1-MTU1-TTU1' WHERE CD_EMPLFONC = 'EF004';

/* Mise à jour du code N4DS pour récupérer l'emploi permanent */
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'MHC1-BHC1-EHC1-HHC1-MHC1-THC1' WHERE CD_EMPLNONPERM = 'EF001';
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'BHM1' WHERE CD_EMPLNONPERM = 'EF002';
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'BHW1' WHERE CD_EMPLNONPERM = 'EF005';
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'NAX2-NCX2-NEX2-NHX2-NMX2-NMX4-NNX2-NOX2-NPX2-NRX2-NSX2-NTX2' WHERE CD_EMPLNONPERM = 'EF006';
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'NAX3-NCX3-NEX3-NHX3-NMX3-NNX3-NOX3-NPX3-NRX3-NSX3-NTX3' WHERE CD_EMPLNONPERM = 'EF007';
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'NAX1-NAX4-NCX1-NCX4-NEX1-NEX4-NHX1-NMX1-NNX1-NNX4-NOX1-NOX4-NPX1-NPX4-NRX1-NRX4-NSX1-NSX4-NTX1-NTX4' WHERE CD_EMPLNONPERM = 'EF008';
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'YYX1' WHERE CD_EMPLNONPERM = 'EF010';
UPDATE ref_emploi_non_permanent SET CD_MOTI_N4DS = 'XAX1-XCX1-XEX1-XHX1-XMX1-XNX1-XOX1-XPX1-XRX1-XSX1-XTX1-YYX9' WHERE CD_EMPLNONPERM = 'EF012';