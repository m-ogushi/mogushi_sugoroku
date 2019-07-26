<?php

class Bothertop01 implements EventInterface
{
    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
    }

    public function turnEnd ( Game $game )
    {
        $user_id = EventUtility::getTopPlayer( $game );
        if ( is_int( $user_id ) ) {
            $game->player[$user_id]->move( -1 );
            $game->view->append( "text", "トップの" . $game->player[$user_id]->getName() . "が1マス戻りました" );
        }
    }
}