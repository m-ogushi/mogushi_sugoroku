<?php
class Goback03 implements EventMethod
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place -= 3;
        $game->view->append( "text", "3マス戻りました" );
    }

    public function turn_end(){

    }
}
