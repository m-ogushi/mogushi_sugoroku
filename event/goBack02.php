<?php

class Goback02 implements EventInterface
{
    private $game;

    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
        $game->getMovingPlayer()->move( -2 );
        $game->view->append( "text", "2マス戻りました" );
    }

    public function turnEnd ( Game $game )
    {
    }
}
