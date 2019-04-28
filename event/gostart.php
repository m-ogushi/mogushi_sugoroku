<?php
class Gostart
{
    //コンストラクタ
    public function __construct( $player ){
        $player->place = 0;
        echo "スタートに戻りました";
    }
}
