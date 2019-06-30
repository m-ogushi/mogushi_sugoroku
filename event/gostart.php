<?php
class Gostart implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game = $this->game;
        $game->player[$game->turn_player]->place = 0;
        $game->view->append( "text", "スタートに戻りました" );
    }

    public function turn_end($game){
    }
}
