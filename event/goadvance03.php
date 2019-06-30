<?php
class Goadvance03 implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->player[$game->turn_player]->place += 3;
        $game->view->append( "text", "3マス進みました" );
    }

    public function turn_end($game){

    }
}
