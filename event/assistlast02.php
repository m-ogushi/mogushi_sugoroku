<?php
class Assistlast02 implements EventInterface
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){

    }

    public function turn_end($game){
        $user_id = EventUtility::get_last_player($game);
        if ( $user_id ){
            $game->player[$user_id]->move(2);
            $game->view->append( "text", "ビリの" . $game->player[$user_id]->name . "が2マス進みました" );
        }
    }
}