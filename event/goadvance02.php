<?php
class Goadvance02
{
    //コンストラクタ
    public function __construct( $player ){
        $player->place += 2; 
        echo "2マス進みました";
    }
}
