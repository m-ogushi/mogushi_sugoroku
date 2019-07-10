<?php
class EventUtility
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public static function get_top_player( $game ){
        $player_place = [];
        $player_id = [];
        for ( $i = 0; $i < count( $game->player ); $i++ ){
            $player_place[] += $game->player[$i]->getPlace();
            $player_id[] = $i;
        }
        array_multisort($player_place, SORT_DESC, $player_id );

        if ( $player_place[0] != $player_place[1] ){
            return $player_id[0];
        } else {
            return;
        }
    }

    public static function get_last_player($game){
        $player_place = [];
        $player_id = [];
        for ( $i = 0; $i < count( $game->player ); $i++ ){
            $player_place[] += $game->player[$i]->getPlace();
            $player_id[] = $i;
        }
        array_multisort($player_place, SORT_ASC, $player_id );

        if ( $player_place[0] != $player_place[1] ){
            return $player_id[0];
        } else {
            return;
        }
    }
}
