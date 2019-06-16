<?php
class Bothertop01 implements EventMethod
{
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){

    }

    public function turn_end(){
        $game = $this->game;
        $Class = new EventFunction( $game );
        $user_id = $Class->get_top_player();
        if ( $user_id ){
            $game->player[$user_id]->place -= 1;
            $game->view->append( "text", "トップの" . $game->player[$user_id]->name . "が1マス戻りました" );
        }
    }
}