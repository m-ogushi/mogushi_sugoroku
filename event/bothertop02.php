<?php
class Bothertop02
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
        $user_id = $Class->get_top_player();
        if ( $user_id ){
            $game->player[$user_id]->place -= 2;
            echo "トップの" . $game->player[$user_id]->name . "が2マス戻りました";
        }
    }
}