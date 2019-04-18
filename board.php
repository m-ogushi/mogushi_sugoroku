<?php
class Board
{
    //コンストラクタ
    public function __construct($csv){
        $fp = fopen( $csv, "r" );
        $line = fgets($fp);
        $elements = explode(',', $line);
        $this->length = $elements[0];
    }
}