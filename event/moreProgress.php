<?php

class Moreprogress implements EventInterface
{
    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
        $game->view->append( "text", "もう一回進めます" );
        $game->getMovingPlayer()->rollDice( $game );
    }

    public function turnEnd ( Game $game )
    {
    }
}