<?php
class Goback01 implements Event
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place -= 1;
        $game->view->append( "text", "1マス戻りました" );
    }

    public function turn_end(){

    }
}
