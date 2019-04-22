<?php
class Goback01
{
    //コンストラクタ
    public function __construct( $player ){
        $player->place -= 1;
        echo "1マス戻りました";
    }
}
