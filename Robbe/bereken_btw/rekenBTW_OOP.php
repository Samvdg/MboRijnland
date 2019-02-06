<?php
require_once './rekenBTW_OOP.php';

class form {

    public $bedrag = 100;                       // het ingevoerde bedrag  (standaard 100)
    public $btw = 21;                           // percentage btw         (standaard 21)
    public $inc = true;                         // boolean, om aan te geven of het bedrag inclusief of exclusief btw is
    public $btwBedrag = 21;                     // hoeveelheid btw van het bedrag
    public $noBtw = 79;                         // bedrag zonder btw
    public $incBtw = 100;                       // bedrag met btw

    /**
     * Return de waarde van het bedrag
     */
    public function getBedrag(){
        return $this->bedrag;
    }

    /**
     * Update de waarde van het bedrag
     * @param bedrag int De nieuwe waarde van het bedrag
     */
    public function setBedrag($bedrag){
        $this->bedrag = $bedrag;
    }

    /**
     * Return de waarde van het btw
     */
    public function getBtw(){
        return $this->btw;
    }

    /**
     * Update de waarde van het btw
     * @param btw int Het nieuwe BTW waarde
     */
    public function setBtw($btw){
        $this->btw = $btw;
    }

    /**
     * 
     */
    public function getInc(){
        return $this->inc;
    }

    public function setInc($inc){
        $this->inc = $inc;
    }

    public function getBtwBedrag(){
        return $this->btwBedrag;
    }

    public function setBtwBedrag($btwBedrag){
        $this->btwBedrag = $btwBedrag;
    }

    public function getNoBtw(){
        return $this->noBtw;
    }

    public function setNoBtw($noBtw){
        $this->noBtw = $noBtw;
    }

    public function getIncBtw(){
        return $this->incBtw;
    }

    public function setIncBtw($incBtw){
        $this->incBtw = $incBtw;
    }


    public function calcBtw($inc){
        if($inc) {
            $btw = $this->getBtw();
            $bedrag = $this->getBedrag();
            $btwBedrag = $btw*$bedrag/121;
            $btwBedrag = number_format($btwBedrag, 2);
            $noBtw = $bedrag - $btwBedrag;
            $this->setBtwBedrag($btwBedrag);
            $this->setNoBtw($noBtw);
            $this->setIncBtw($bedrag);
        } else {
            $btw = $this->getBtw();
            $bedrag = $this->getBedrag();
            $btwBedrag = $btw/100*$bedrag;
            $btwBedrag = number_format($btwBedrag, 2);
            $incBtw = $bedrag + $btwBedrag;
            $this->setBtwBedrag($btwBedrag);
            $this->setNoBtw($bedrag);
            $this->setIncBtw($incBtw);
        }
    }
}

$form = new form();

    if(isset($_POST["submit"])){
        $bedrag = $_POST["bedrag"];
        $inc = $_POST["inc"];
        if($bedrag || $inc != null || " "){
            $form->setBedrag($bedrag);
            $form->setInc($inc);
            $form->calcBtw($inc);
        }
    }

echo '
<html>
    <table style="width: 100%">
        <tr>
            <td>
                <form method="post" action="rekenBTW_OOP.php">
                    bedrag: <input name="bedrag" type="text" placeholder="'. $form->getBedrag() .',-" ><br>
                    Is het aangegeven bedrag:<br>
                    - inclusief BTW: <input type="radio" name="inc" value="true" <br><br>
                    - exclusief BTW: <input type="radio" name="inc" value="false" ><br><br>
                    <input type="submit" name="submit" value="submit">
                </form>
            <td>
            <td>
                btw: '. $form->getBtw() .'% <br>
                btw bedrag: €'. $form->getBtwBedrag() .',- <br>
                zonder btw: €'. $form->getNoBtw() .',-<br>
                met btw: €'. $form->getIncBtw() .' <br>
            <td>
        </tr>
    </table>
</html>
';

