<?php

class Goback01 implements EventInterface
{
    private $game;

    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
        $game->getMovingPlayer()->move( -1 );
        $game->view->append( "text", "1マス戻りました" );
    }

    public function turn_end ( Game $game )
    {
    }
}
