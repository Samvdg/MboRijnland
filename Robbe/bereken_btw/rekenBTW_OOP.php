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
     * Return boolean voor inclusief btw
     */
    public function getInc(){
        return $this->inc;
    }

    /**
     * Update boolean voor inclusief btw
     * @param inc bool Boolean of het bedrag inclusief of exclusief btw is
     */
    public function setInc($inc){
        $this->inc = $inc;
    }

    /**
     * Return waarde btw van het bedrag
     */
    public function getBtwBedrag(){
        return $this->btwBedrag;
    }

    /**
     * Update waarde btw van het bedrag
     * @param btwBedrag int Waarde van het nieuwe bedrag
     */
    public function setBtwBedrag($btwBedrag){
        $this->btwBedrag = $btwBedrag;
    }

    /**
     * Return waarde van het bedrag exclusief btw
     */
    public function getNoBtw(){
        return $this->noBtw;
    }

    /**
     * Update waarde van het bedrag exclusief btw
     * @param int noBtw Nieuwe bedrag exclusief btw
     */
    public function setNoBtw($noBtw){
        $this->noBtw = $noBtw;
    }

    /**
     * Return waarde van bedrag inclusief btw
     */
    public function getIncBtw(){
        return $this->incBtw;
    }

    /**
     * Update waarde van het bedrag inclusief btw
     * @param int incBtw Nieuwe bedrag inclusief btw
     */
    public function setIncBtw($incBtw){
        $this->incBtw = $incBtw;
    }


    /**
     * Bereken en update het btw en en bedrag
     * @param inc bool Dit is om aan te geven of het gegeven bedrag inclusief of exclusief btw is
     */
    public function calcBtw($inc){
        $btw = $this->getBtw();
        $bedrag = $this->getBedrag();
        $btwBedrag = number_format($btwBedrag, 2);
        
        if($inc) {
            $btwBedrag = $btw*$bedrag/121;
            $noBtw = $bedrag - $btwBedrag;
            $this->setBtwBedrag($btwBedrag);
            $this->setNoBtw($noBtw);
            $this->setIncBtw($bedrag);
        } else {
            $btwBedrag = $bedrag*($btw/100);
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

// echo inplaats van HTML om makkelijker te communiceren met PHP
echo '
<html>
    <table style="width: 100%">
        <tr>
            <td style="width: 50%;">
                <form method="post" action="rekenBTW_OOP.php">
                    bedrag: €<input required name="bedrag" type="text" placeholder="'. $form->getBedrag() .'" >,-<br>
                    Is het aangegeven bedrag:<br>
                    - inclusief BTW: <input required type="radio" name="inc" value="true" <br><br>
                    - exclusief BTW: <input required type="radio" name="inc" value="false" ><br><br>
                    <input type="submit" name="submit" value="submit">
                </form>
            </td>
            <td style="width: 50%;">
                bedrag: €'.$form->getBedrag() .',-<br>
                btw: '. $form->getBtw() .'% <br>
                btw bedrag: €'. $form->getBtwBedrag() .',- <br>
                zonder btw: €'. $form->getNoBtw() .',-<br>
                met btw: €'. $form->getIncBtw() .' <br>
            </td>
        </tr>
    </table>
</html>
';

