<?php
class Goback02
{
    //コンストラクタ
    public function __construct( $player ){
        $player->place -= 2;
        echo "2マス戻りました" . PHP_EOL;
    }
}
