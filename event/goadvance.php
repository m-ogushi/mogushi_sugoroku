<?php
class Goadvance
{
    //コンストラクタ
    public function __construct( $player, $count ){
        $player->place += $count; 
    }
}
