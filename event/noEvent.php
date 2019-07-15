<?php

class noEvent implements EventInterface
{
    public function player ( Game $game )
    {
        $game->view->append( "text", "イベントはありません" );
    }

    public function turn_end ( Game $game )
    {
        $game->view->append( "text", "イベントはありません" );
    }
}