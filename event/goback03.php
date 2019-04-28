<?php
class Goback03
{
    //コンストラクタ
    public function __construct( $player ){
        $player->place -= 3;
        echo "3マス戻りました";
    }
}
