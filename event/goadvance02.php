<?php
class Goadvance02 implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->player[$game->turn_player]->place += 2;
        $game->view->append( "text", "2マス進みました" );
    }

    public function turn_end($game){

    }
}
