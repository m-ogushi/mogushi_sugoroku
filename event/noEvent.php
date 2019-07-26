<?php

class noEvent implements EventInterface
{
    public function player ( Game $game )
    {
        $game->view->append( "text", "イベントはありません" );
    }

    public function turnEnd ( Game $game )
    {
        $game->view->append( "text", "イベントはありません" );
    }
}