<?php

class Goadvance03 implements EventInterface
{
    private $game;

    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
        $game->getMovingPlayer()->move( 3 );
        $game->view->append( "text", "3マス進みました" );
    }

    public function turn_end ( Game $game )
    {
    }
}
