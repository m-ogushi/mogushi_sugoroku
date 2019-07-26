<?php

class Bothertop03 implements EventInterface
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
            $game->player[$user_id]->move( -3 );
            $game->view->append( "text", "トップの" . $game->player[$user_id]->getName() . "が3マス戻りました" );
        }
    }
}