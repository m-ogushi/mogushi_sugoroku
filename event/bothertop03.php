<?php
class Bothertop03 implements EventInterface
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){

    }

    public function turn_end($game){
        $user_id = EventUtility::get_top_player($game);
        if ( $user_id ){
            $game->player[$user_id]->move(-3);
            $game->view->append( "text", "トップの" . $game->player[$user_id]->name . "が3マス戻りました" );
        }
    }
}