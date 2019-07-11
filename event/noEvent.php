<?php
class noEvent implements EventInterface
{
    public function player($game){
        $game->view->append( "text", "イベントはありません" );
    }

    public function turn_end($game){
        $game->view->append( "text", "イベントはありません" );
    }
}