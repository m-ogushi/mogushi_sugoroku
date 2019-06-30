<?php
class Goadvance01 implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->player[$game->turn_player]->place += 1;
        $game->view->append( "text", "1マス進みました" );
    }

    public function turn_end($game){

    }
}
