<?php

class Rest implements EventInterface
{
    private $game;

    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
        $game->getMovingPlayer()->addRestFlag();
        $game->view->append( "text", "1回休みです" );
    }

    public function turn_end ( Game $game )
    {
    }
}
