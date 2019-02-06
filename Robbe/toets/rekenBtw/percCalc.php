<?php
/*
 *  klasse om percentages incl en excl te berekenen.
 *  
 *  use public bedrag and private percentage.
 */
 
class percCalc 
{
    public $_bedrag;
    private $_percentage = 21;
    
    /*
     * @return _percentage
     */
    public function setPercentage($percentage)
    {
        $this->_percentage = $percentage;
    }

    /*
     * @return _percentage
     */
    public function getPercentage()
    {
        return $this->_percentage;
    }

    public function incl()
    {
        return $this->_bedrag * ((100 + $this->_percentage)/100);
    }

    public function excl()
    {
        return $this->_bedrag / ((100 + $this->_percentage)/100);
    }
}
