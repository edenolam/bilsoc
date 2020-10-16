<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialQuestionsGenerales {

    /**
     * @var integer
     */
    private $idBscHanditorialQuestionsGenerales;
    private $bilanSocialConsolide;

    /**
     * @var boolean
     */
    private $qA3;

    /**
     * @var boolean
     */
    /*private $qA6;*/
    /**
     * @var integer
     */
    /*private $rA61;*/

    /**
     * @var boolean
     */
    /*private $qA7;*/

    /**
     * @var integer
     */
    /*private $rA71;*/

    /**
     * @var boolean
     */
    /*private $qA8;*/

    /**
     * @var integer
     */
    /*private $rA81;*/

    /**
     * @var boolean
     */
    /*private $rA9;*/

    /**
     * @var integer
     */
    /*private $rA91;*/

    /**
     * @var boolean
     */
    /*private $rA10;*/

    /**
     * @var integer
     */
    /*private $rA101;*/

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var string
     */
    private $fgStat;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var string
     */
    private $qA17;
    /**
     * @var integer
     */
    /*private $qA511;*/
    /**
     * @var integer
     */
    /*private $qA512;*/
    /**
     * @var integer
     */
    /*private $qA513;*/
    /**
     * @var integer
     */
    /*private $qA521;*/
    /**
     * @var integer
     */
    /*private $qA522;*/
    /**
     * @var integer
     */
    /*private $qA523;*/
    /**
     * @var integer
     */
    /*private $qA62;*/
    /**
     * @var integer
     */
    /*private $qA72;*/
    /**
     * @var integer
     */
    /*private $qA82;*/


    function getIdBscHanditorialQuestionsGenerales() {
        return $this->idBscHanditorialQuestionsGenerales;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getFgStat() {
        return $this->fgStat;
    }

    function getDtCrea(): \DateTime {
        return $this->dtCrea;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function getDtModi(): \DateTime {
        return $this->dtModi;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function setIdBscHanditorialQuestionsGenerales($idBscHanditorialQuestionsGenerales) {
        $this->idBscHanditorialQuestionsGenerales = $idBscHanditorialQuestionsGenerales;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setFgStat($fgStat) {
        $this->fgStat = $fgStat;
    }

    function setDtCrea(\DateTime $dtCrea) {
        $this->dtCrea = $dtCrea;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function setDtModi(\DateTime $dtModi) {
        $this->dtModi = $dtModi;
    }

    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    function getQA3() {
        return $this->qA3;
    }

    /*function getQA6() {
        return $this->qA6;
    }

    function getRA61() {
        return $this->rA61;
    }

    function getQA7() {
        return $this->qA7;
    }

    function getRA71() {
        return $this->rA71;
    }

    function getQA8() {
        return $this->qA8;
    }

    function getRA81() {
        return $this->rA81;
    }

    function getRA9() {
        return $this->rA9;
    }

    function getRA91() {
        return $this->rA91;
    }

    function getRA10() {
        return $this->rA10;
    }

    function getRA101() {
        return $this->rA101;
    }

    function setQA3($qA3) {
        $this->qA3 = $qA3;
    }

    function setQA6($qA6) {
        $this->qA6 = $qA6;
    }

    function setRA61($rA61) {
        $this->rA61 = $rA61;
    }

    function setQA7($qA7) {
        $this->qA7 = $qA7;
    }

    function setRA71($rA71) {
        $this->rA71 = $rA71;
    }

    function setQA8($qA8) {
        $this->qA8 = $qA8;
    }

    function setRA81($rA81) {
        $this->rA81 = $rA81;
    }

    function setRA9($rA9) {
        $this->rA9 = $rA9;
    }

    function setRA91($rA91) {
        $this->rA91 = $rA91;
    }

    function setRA10($rA10) {
        $this->rA10 = $rA10;
    }

    function setRA101($rA101) {
        $this->rA101 = $rA101;
    }*/

    /**
     * @return string
     */
    public function getQA17()
    {
        return $this->qA17;
    }

    /**
     * @param string $qA17
     */
    public function setQA17($qA17)
    {
        $this->qA17 = $qA17;
    }

    /**
     * @param boolean $qA3
     */
    public function setQA3($qA3)
    {
        $this->qA3 = $qA3;
    }

    /**
     * @return int
     */
    /*public function getQA511()
    {
        return $this->qA511;
    }*/

    /**
     * @param int $qA511
     */
   /* public function setQA511($qA511)
    {
        $this->qA511 = $qA511;
    }*/

    /**
     * @return int
     */
    /*public function getQA512()
    {
        return $this->qA512;
    }*/

    /**
     * @param int $qA512
     */
    /*public function setQA512($qA512)
    {
        $this->qA512 = $qA512;
    }
*/
    /**
     * @return int
     */
    /*public function getQA513()
    {
        return $this->qA513;
    }*/

    /**
     * @param int $qA513
     */
    /*public function setQA513($qA513)
    {
        $this->qA513 = $qA513;
    }*/

    /**
     * @return int
     */
    /*public function getQA521()
    {
        return $this->qA521;
    }*/

    /**
     * @param int $qA521
     */
    /*public function setQA521($qA521)
    {
        $this->qA521 = $qA521;
    }*/

    /**
     * @return int
     */
    /*public function getQA522()
    {
        return $this->qA522;
    }*/

    /**
     * @param int $qA522
     */
    /*public function setQA522($qA522)
    {
        $this->qA522 = $qA522;
    }*/

    /**
     * @return int
     */
    /*public function getQA523()
    {
        return $this->qA523;
    }*/

    /**
     * @param int $qA523
     */
    /*public function setQA523($qA523)
    {
        $this->qA523 = $qA523;
    }*/

    /**
     * @return int
     */
    /*public function getQA62()
    {
        return $this->qA62;
    }*/

    /**
     * @param int $qA62
     */
    /*public function setQA62($qA62)
    {
        $this->qA62 = $qA62;
    }*/

    /**
     * @return int
     */
   /* public function getQA72()
    {
        return $this->qA72;
    }*/

    /**
     * @param int $qA72
     */
    /*public function setQA72($qA72)
    {
        $this->qA72 = $qA72;
    }
*/
    /**
     * @return int
     */
    /*public function getQA82()
    {
        return $this->qA82;
    }*/

    /**
     * @param int $qA82
     */
    /*public function setQA82($qA82)
    {
        $this->qA82 = $qA82;
    }*/


}
