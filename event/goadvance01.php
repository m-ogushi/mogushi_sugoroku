<?php
class Goadvance01
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place += 1;
        echo "1マス進みました";
    }

    public function turn_end(){

    }
}
