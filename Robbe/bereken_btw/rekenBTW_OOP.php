<?php
include './rekenBTW_OOP';

class form {

public $class = new form();

public $bedrag = 100;                      // het ingevoerde bedrag  (standaard 100)
public $btw = 21;                          // percentage btw         (standaard 21)
public $inc = true;                        // boolean, om aan te geven of het bedrag inclusief of exclusief btw is
public $btwBedrag = $btw/100*$bedrag;      // hoeveelheid btw van het bedrag
public $noBtw = $bedrag - $btwBedrag;      // bedrag zonder btw
public $incBtw = $bedrag;                  // bedrag met btw


    function __construct() {
        echo'
            <html>
                <form method="post" action="'. $_SERVER['PHP_SELF'] .'">
                    inclusief BTW:<input type="radio" name="btw" value="inc" > <br>
                    exclusief BTW<input type="radio" name="btw" value="exc" ><br><br>
                    bedrag: <input name="bedrag" type="text" placeholder="€<?php echo $bedrag; ?>,-" ><br>
                    btw: $<?php echo $btw; ?>,- <br>
                    zonder btw: $<?php echo $noBtw; ?>,-<br>
                    met btw: €<?php echo $incBtw; ?> <br>
                    <input type="submit" name="submit" value="submit">
                </form>
            </html>
    '
    }
}
?>

<html>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        inclusief BTW:<input type="radio" name="btw" value="inc" > <br>
        exclusief BTW<input type="radio" name="btw" value="exc" ><br><br>
        bedrag: <input name="bedrag" type="text" placeholder="€<?php echo $bedrag; ?>,-" ><br>
        btw: $<?php echo $btw; ?>,- <br>
        zonder btw: $<?php echo $noBtw; ?>,-<br>
        met btw: €<?php echo $incBtw; ?> <br>
        <input type="submit" name="submit" value="submit">
    </form>
</html>

