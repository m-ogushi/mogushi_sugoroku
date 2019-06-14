<?php
class Goadvance03 implements Event
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place += 3;
        $game->view->append( "text", "3マス進みました" );
    }

    public function turn_end(){

    }
}
