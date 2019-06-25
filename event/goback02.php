<?php
class Goback02 implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place -= 2;
        $game->view->append( "text", "2マス戻りました" );
    }

    public function turn_end(){

    }
}
