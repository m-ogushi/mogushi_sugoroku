<?php
class Goadvance02 implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct()
    {
    }

    public function player(Game $game)
    {
        $game->getMovingPlayer()->move(2);
        $game->view->append( "text", "2マス進みました" );
    }

    public function turn_end(Game $game)
    {
    }
}
