<?php

class EventUtility
{
    //コンストラクタ
    public function __construct ()
    {
    }

    public static function getTopPlayer ( Game $game )
    {
        $player_place = $game->getAllPlayerPlace();

        arsort( $player_place );

        if ( $player_place[0] != $player_place[1] ) {
            return key( $player_place );
        } else {
            return;
        }
    }

    public static function getLastPlayer ( Game $game )
    {
        $player_place = $game->getAllPlayerPlace();

        asort( $player_place );

        if ( $player_place[0] != $player_place[1] ) {
            return key( $player_place );
        } else {
            return;
        }
    }
}
