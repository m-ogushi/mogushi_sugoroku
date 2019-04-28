<?php
class Player
{
    //コンストラクタ
    public function __construct( $player )
    {
        $this->name  = $player;
        $this->place = 0;
        $this->rest = 0;
    }
}
