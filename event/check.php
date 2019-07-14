<?php
class Check implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct()
    {
    }

    public function player(Game $game)
    {
        $game->view->append( "text", "ちょうどチェックポイントに止まりました" );
    }

    public function turn_end(Game $game)
    {
    }
}
