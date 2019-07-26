<?php

class Gostart implements EventInterface
{
    private $game;

    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
        $game->getMovingPlayer()->backStart();
        $game->view->append( "text", "スタートに戻りました" );
    }

    public function turnEnd ( Game $game )
    {
    }
}
