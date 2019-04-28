<?php
class Rest
{
    //コンストラクタ
    public function __construct( $player ){
        $player->rest++;
        echo "1回休みです";
    }
}
