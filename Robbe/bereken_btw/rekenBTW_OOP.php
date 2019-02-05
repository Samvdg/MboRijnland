<?php
include $_SERVER['PHP_SELF'];

class form {
public $class = new form();

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
    if(isset($_POST["submit"])){
        $bedrag = $_POST["bedrag"];
        if($_POST["btw"] == "inc"){
            $btw = (21*$bedrag)/121;
        } elseif($_POST["btw"] == "exc") {
            $btw = $bedrag*0.21;
            $noBtw = $bedrag;
            $incBtw = $bedrag + $btw;
        }
    }

    if(!isset($bedrag)){
        $bedrag = 100;
        $btw = $bedrag*0.21;
        $noBtw = $bedrag-$btw;
        $incBtw = $bedrag;
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

