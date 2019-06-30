<?php
class Rest implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->player[$game->turn_player]->rest++;
        $game->view->append( "text", "1回休みです" );
    }

    public function turn_end($game){

    }
}
