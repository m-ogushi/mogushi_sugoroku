<?php
class noEvent implements EventInterface
{
    public function player($game){
        $game->view->append( "text", "イベントはありませんでした" );
    }

    public function turn_end($game){
        $game->view->append( "text", "イベントはありませんでした" );
    }
}