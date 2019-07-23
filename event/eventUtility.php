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

        $first_user_id = ( array_slice( $player_place, 0, 1, true ) );
        $second_user_id = ( array_slice( $player_place, 1, 1, true )  );

        if ( reset( $first_user_id ) != reset( $second_user_id ) ) {
            return key( $first_user_id );
        } else {
            return;
        }
    }

    public static function getLastPlayer ( Game $game )
    {
        $player_place = $game->getAllPlayerPlace();

        asort( $player_place );

        $first_user_id = ( array_slice( $player_place, 0, 1, true ) );
        $second_user_id = ( array_slice( $player_place, 1, 1, true )  );

        if ( reset( $first_user_id ) != reset( $second_user_id ) ) {
            return key( $first_user_id );
        } else {
            return;
        }
    }
}
