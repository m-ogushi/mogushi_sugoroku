<?php
class Gostart
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->place = 0;
        $game->view->append( "text", "スタートに戻りました" );
    }

    public function turn_end(){

    }
}
