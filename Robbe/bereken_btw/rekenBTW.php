<?php
require_once './rekenBTW.php';

$bedrag = 100;                      // het ingevoerde bedrag  (standaard 100)
$btw = 21;                          // percentage btw         (standaard 21)
$inc = true;                        // boolean, om aan te geven of het bedrag inclusief of exclusief btw is
$btwBedrag = $btw/100*$bedrag;      // hoeveelheid btw van het bedrag
$noBtw = $bedrag - $btwBedrag;      // bedrag zonder btw
$incBtw = $bedrag;                  // bedrag met btw

function berekenBTW($inc, $btw, $bedrag) {
    if($inc) {
        $money = $btw*$bedrag/121;
        return number_format($money, 2);
    } else {
        $money = $btw/100*$bedrag;
        return number_format($money, 2);
    }
}

if(isset($_POST["submit"])){
    $bedrag = $_POST["bedrag"];     // 
    $inc = $_POST["inc"];
    $btwBedrag = berekenBTW($inc, $btw, $bedrag);
    if($inc == "true"){
        $noBtw = $bedrag - $btwBedrag;
        $incBtw = $bedrag;
    } elseif($inc == "false") {
        $noBtw = $bedrag;
        $incBtw = $bedrag + $btwBedrag;
    }
}

echo '
<html>
    <table style="width: 100%">
        <tr>
            <td style="width: 50%; text-align: center;">
                <form method="post" action="rekenBTW.php">
                    bedrag: €<input name="bedrag" type="text" placeholder="'. $bedrag .'" >,-<br>
                    Is het aangegeven bedrag:<br>
                    - inclusief BTW: <input type="radio" name="inc" value="true" <br><br>
                    - exclusief BTW: <input type="radio" name="inc" value="false" ><br><br>
                    <input type="submit" name="submit" value="submit">
                </form>
            <td>
            <td style="width: 50%; text-align: center;">
                bedrag: €'.$bedrag.',- <br>
                btw: '. $btw .'% <br>
                btw bedrag: €'. $btwBedrag .',- <br>
                zonder btw: €'. $noBtw .',-<br>
                met btw: €'. $incBtw .' <br>
            <td>
        </tr>
    </table>
</html>
';