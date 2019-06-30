<?php
class Dice
{
    //コンストラクタ
    public function __construct( $planes )
    {
        $this->min = 1;
        $this->max = $planes;
    }

    public function roll()
    {
        $result = mt_rand( $this->min, $this->max );
        echo $result . "の目が出た" . "\n";
        return $result;

    }
}
