<?php
class Goadvance03
{
    //コンストラクタ
    public function __construct( $player ){
        $player->place += 3; 
        echo "3マス進みました" . PHP_EOL;
    }
}
