<?php
class Assistlast03
{
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){

    }

    public function turn_end(){
        $game = $this->game;
        $Class = new eventmethod( $game );
        $user_id = $Class->get_last_player();
        if ( $user_id ){
            $game->player[$user_id]->place += 3;
            echo "ビリの" . $game->player[$user_id]->name . "が3マス進みました";
        }
    }
}