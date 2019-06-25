<?php
class Player
{
    //コンストラクタ
    public function __construct( $player, $board )
    {
        $this->name  = $player;
        $this->place = 0;
        $this->rest = 0;
        $this->check_in = FALSE;
        $this->not_checked = $board->check_place;
    }

    public function yourTurn($game) {
        echo 'あなたの番だからこそ';
    }
}
