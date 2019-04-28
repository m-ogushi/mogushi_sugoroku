<?php
class Replace
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;

        do{
            $replace_oppoment = mt_rand( 0, count( $game->player ) - 1 );
        } while ( $game->player[$replace_oppoment]->name == $game->player[$game->turn_player]->name );

        $my_place = $game->player[$game->turn_player]->place;
        $oppoment_place = $game->player[$replace_oppoment]->place;

        $game->player[$game->turn_player]->place = $oppoment_place;
        $game->player[$replace_oppoment]->place = $my_place;
        echo $game->player[$game->turn_player]->name . "さんと" . $game->player[$replace_oppoment]->name . "さんが入れ替わりました";
    }

    public function turn_end(){

    }
}
