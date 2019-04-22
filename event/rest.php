<?php
class rest
{
    //コンストラクタ
    public function __construct( $player ){
        $player->rest++;
        echo "1回休みです" . PHP_EOL;
    }
}
