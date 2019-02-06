<?php
require './percCalc.php';

class extractBTW extends percCalc {
    private $inc;
    private $btwBedrag;

    function getBedrag() {
        return $this->_bedrag;
    }
    
    function setBedrag($bedrag) {
        $this->_bedrag = $bedrag;
    }

    function setInc($inc) {
        $this->inc = $inc;
    }

    function getInc() {
        return $this->inc;
    }

    function getBtwBedrag() {
        return $this->btwBedrag;
    }

    function setBtwBedrag($btwBedrag) {
        $this->btwBedrag = $btwBedrag;
    }

    function calcBtwBedrag() {
        $btw = $this->getPercentage();
        $bedrag = $this->getBedrag();
        $inc = $this->getInc();
        // die($inc);
        if($inc === "true") {
            // die("its true");
            $btwBedrag = $btw*$bedrag/121;
            $btwBedrag = number_format($btwBedrag, 2);
            $this->setBtwBedrag($btwBedrag);
        } else {
            // die("its false");
            $btwBedrag = $bedrag*($btw/100);
            $btwBedrag = number_format($btwBedrag, 2);
            $this->setBtwBedrag($btwBedrag);
        }
    }
}

$extract = new extractBTW();
if(isset($_POST["submit"])){
    if(empty($_POST["bedrag"])){
        echo "<script>let jochie = alert('Please fill in a value');</script>";
    } else {
        $extract->setInc($_POST["inc"]);
        $extract->setBedrag($_POST["bedrag"]);
        $extract->calcBtwBedrag();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="./extractBTW.php" method='post'>
    <label for="bedrag">Bedrag: </label> <input required type="number" name="bedrag" placeholder="<?php echo $extract->getBedrag(); ?>"><br>
    Is het aangegeven bedrag:<br>
                    - inclusief BTW: <input required type="radio" name="inc" value="true" ><br><br>
                    - exclusief BTW: <input required type="radio" name="inc" value="false" ><br><br>
                    <input type="submit" name="submit" value="submit">
</form>

    <p>Ingevoerde bedrag: <?php echo $extract->getBedrag(); ?></p>
    <p>Btw percentage: <?php echo $extract->getPercentage(); ?></p>
    <p>Btw bedrag: <?php echo $extract->getBtwBedrag(); ?></p>
</body>
</html>
