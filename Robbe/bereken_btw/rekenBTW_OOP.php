<?php
require_once './rekenBTW_OOP.php';

class form {

    public $bedrag = 100;                       // het ingevoerde bedrag  (standaard 100)
    public $btw = 21;                           // percentage btw         (standaard 21)
    public $inc = true;                         // boolean, om aan te geven of het bedrag inclusief of exclusief btw is
    public $btwBedrag = 21;                     // hoeveelheid btw van het bedrag
    public $noBtw = 79;                         // bedrag zonder btw
    public $incBtw = 100;                       // bedrag met btw

    public function getBedrag(){
        return $this->bedrag;
    }

    public function setBedrag($bedrag){
        $this->bedrag = $bedrag;
    }

    public function getBtw(){
        return $this->btw;
    }

    public function setBtw($btw){
        $this->btw = $btw;
    }

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
        return $incBtw;
    }

    public function setIncBtw($incBtw){
        $this->incBtw = $incBtw;
    }


    function calcBtw($inc){
        if($inc) {
            $btw = $this->getBtw();
            $bedrag = $this->getBedrag();
            $money = $btw*$bedrag/121;
            return number_format($money, 2);
        } else {
            $btw = $this->getBtw();
            $bedrag = $this->getBedrag();
            $money = $btw/100*$bedrag;
            return number_format($money, 2);
        }
    }
}

$form = new form();

// echo '
// <html>
//     <table style="width: 100%">
//         <tr>
//             <td>
//                 <form method="post" action="rekenBTW.php">
//                     bedrag: <input name="bedrag" type="text" placeholder="'. $bedrag .',-" ><br>
//                     Is het aangegeven bedrag:<br>
//                     - inclusief BTW: <input type="radio" name="inc" value="true" <br><br>
//                     - exclusief BTW: <input type="radio" name="inc" value="false" ><br><br>
//                     <input type="submit" name="submit" value="submit">
//                 </form>
//             <td>
//             <td>
//                 btw: '. $btw .'% <br>
//                 btw bedrag: €'. $btwBedrag .',- <br>
//                 zonder btw: €'. $noBtw .',-<br>
//                 met btw: €'. $incBtw .' <br>
//             <td>
//         </tr>
//     </table>
// </html>
// ';

