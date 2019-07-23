<?php

class Bothertop02 implements EventInterface
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
        $user_id = EventUtility::getTopPlayer( $game );
        if ( is_int( $user_id ) ) {
            $game->player[$user_id]->move( -2 );
            $game->view->append( "text", "トップの" . $game->player[$user_id]->getName() . "が2マス戻りました" );
        }
    }
}