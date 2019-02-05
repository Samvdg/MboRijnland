<?php
include './rekenBTW_OOP';

class form {

    public $bedrag = 100;                      // het ingevoerde bedrag  (standaard 100)
    public $btw = 21;                          // percentage btw         (standaard 21)
    public $inc = true;                        // boolean, om aan te geven of het bedrag inclusief of exclusief btw is
    public $btwBedrag = $this->calcBtw($inc)   // hoeveelheid btw van het bedrag
    public $noBtw = $bedrag - $btwBedrag;      // bedrag zonder btw
    public $incBtw = $bedrag;                  // bedrag met btw

    public function getBedrag(){
        return $bedrag;
    }

    public function setBedrag($bedrag){
        
    }

    public function getBtw(){
        return $btw;
    }

    public function getInc(){
        return $inc;
    }

    public function getBtwBedrag(){
        return $btwBedrag;
    }

    public function getBedrag(){
        return $noBtw;
    }

    public function incBtw(){
        return $incBtw;
    }


    function calcBtw($inc){
        if($inc) {
            $btw = this->getBtw();
            $bedrag = this->getBedrag();
            $money = $btw*$bedrag/121;
            return number_format($money, 2);
        } else {
            $btw = this->getBtw();
            $bedrag = this->getBedrag();
            $money = $btw/100*$bedrag;
            return number_format($money, 2);
        }
    }
}

echo '
<html>
    <table style="width: 100%">
        <tr>
            <td>
                <form method="post" action="rekenBTW.php">
                    bedrag: <input name="bedrag" type="text" placeholder="'. $bedrag .',-" ><br>
                    Is het aangegeven bedrag:<br>
                    - inclusief BTW: <input type="radio" name="inc" value="true" <br><br>
                    - exclusief BTW: <input type="radio" name="inc" value="false" ><br><br>
                    <input type="submit" name="submit" value="submit">
                </form>
            <td>
            <td>
                btw: '. $btw .'% <br>
                btw bedrag: €'. $btwBedrag .',- <br>
                zonder btw: €'. $noBtw .',-<br>
                met btw: €'. $incBtw .' <br>
            <td>
        </tr>
    </table>
</html>
';

