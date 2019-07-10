<?php
class Rest implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->player[$game->getTurnPlayer()]->addRestFlag();
        $game->view->append( "text", "1回休みです" );
    }

    public function turn_end($game){

    }
}
