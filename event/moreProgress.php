<?php

class Moreprogress
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

    public function turn_end ( Game $game )
    {
    }
}