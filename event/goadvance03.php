<?php
class Goadvance03
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place += 3;
        echo "3マス進みました";
    }

    public function turn_end(){

    }
}
