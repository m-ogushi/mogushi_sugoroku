<?php
class Dice
{
    //コンストラクタ
    public function __construct( $planes )
    {
        $this->min = 1;
        $this->max = $planes;
    }
}
