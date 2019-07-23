<?php

class Assistlast01 implements EventInterface
{
    //コンストラクタ
    public function __construct ()
    {
    }

    public function player ( Game $game )
    {
    }

    public function turn_end ( Game $game )
    {
        $user_id = EventUtility::getLastPlayer( $game );
        if ( is_int( $user_id ) ) {
            $game->player[$user_id]->move( 1 );
            $game->view->append( "text", "ビリの" . $game->player[$user_id]->getName() . "が1マス進みました" );
        }
    }
}