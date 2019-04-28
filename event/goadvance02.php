<?php
class Goadvance02
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place += 2;
        echo "2マス進みました";
    }

    public function turn_end(){

    }
}
