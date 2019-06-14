<?php
class Bothertop03 implements Event
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
            $game->player[$user_id]->place -= 3;
            $game->view->append( "text", "トップの" . $game->player[$user_id]->name . "が3マス戻りました" );
        }
    }
}