<?php
class Assistlast02 implements Event
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
            $game->player[$user_id]->place += 2;
            $game->view->append( "text", "ビリの" . $game->player[$user_id]->name . "が2マス進みました" );
        }
    }
}