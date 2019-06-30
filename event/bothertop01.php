<?php
class Bothertop01 implements EventInterface
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){

    }

    public function turn_end($game){
        $Class = new EventFunction( $game );
        $user_id = $Class->get_top_player();
        if ( $user_id ){
            $game->player[$user_id]->place -= 1;
            $game->view->append( "text", "トップの" . $game->player[$user_id]->name . "が1マス戻りました" );
        }
    }
}