<?php
class Goback
{
    //コンストラクタ
    public function __construct( $player, $count ){
        $player->place -= $count;
    }
}
