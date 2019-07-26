<?php
require "commonUtility.php";

class EventUtility
{
    //コンストラクタ
    public function __construct ()
    {
    }

    public static function getTopPlayer ( Game $game )
    {
        $player_id_place = $game->getAllPlayerPlace();

        arsort( $player_id_place );

        $first_player_id_place = CommonUtility::getFirstCombinationInArray( $player_id_place );
        if ( $first_player_id_place ){
            return key( $first_player_id_place );
        }
    }

    public static function getLastPlayer ( Game $game )
    {
        $player_id_place = $game->getAllPlayerPlace();

        asort( $player_id_place );

        $last_player_id_place = CommonUtility::getFirstCombinationInArray( $player_id_place );
        if ( $last_player_id_place ){
            return key( $last_player_id_place );
        }
    }
}
