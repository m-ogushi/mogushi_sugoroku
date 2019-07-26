<?php

class Assistlast03 implements EventInterface
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
        $user_id = EventUtility::getLastPlayer( $game );
        if ( is_int( $user_id ) ) {
            $game->player[$user_id]->move( 3 );
            $game->view->append( "text", "ビリの" . $game->player[$user_id]->getName() . "が3マス進みました" );
        }
    }
}