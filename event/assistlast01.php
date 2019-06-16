<?php
class Assistlast01 implements EventMethod
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
        $user_id = $Class->get_last_player();
        if ( $user_id ){
            $game->player[$user_id]->place += 1;
            $game->view->append( "text", "ビリの" . $game->player[$user_id]->name . "が1マス進みました" );
        }
    }
}