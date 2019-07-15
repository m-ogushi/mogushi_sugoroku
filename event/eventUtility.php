<?php

class EventUtility
{
    //コンストラクタ
    public function __construct ()
    {
    }

    public static function getTopPlayer ( $game )
    {
        $player_place = self::getAllPlayerPlace( $game->player );

        arsort( $player_place );

        if ( $player_place[0] != $player_place[1] ) {
            return key( $player_place );
        } else {
            return;
        }
    }

    public static function getLastPlayer ( $game )
    {
        $player_place = self::getAllPlayerPlace( $game->player );

        asort( $player_place );

        if ( $player_place[0] != $player_place[1] ) {
            return key( $player_place );
        } else {
            return;
        }
    }

    public static function getAllPlayerPlace ( $players )
    {
        $player_place = [];
        for ( $i = 0; $i < count( $players ); $i++ ) {
            $player_place[] += $players[$i]->getPlace();
        }

        return $player_place;
    }
}
