<?php
class EventFunction
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function get_top_player(){
        $game = $this->game;
        $player_place = [];
        $player_id = [];
        for ( $i = 0; $i < count( $game->player ); $i++ ){
            $player_place[] += $game->player[$i]->place;
            $player_id[] = $i;
        }
        array_multisort($player_place, SORT_DESC, $player_id );

        if ( $player_place[0] != $player_place[1] ){
            return $player_id[0];
        } else {
            return;
        }
    }

    public function get_last_player(){
        $game = $this->game;
        $player_place = [];
        $player_id = [];
        for ( $i = 0; $i < count( $game->player ); $i++ ){
            $player_place[] += $game->player[$i]->place;
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
