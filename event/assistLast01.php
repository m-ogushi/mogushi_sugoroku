<?php
class Assistlast01 implements EventInterface
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
    }

    public function turn_end($game){
        $user_id = EventUtility::get_last_player($game);
        if ( $user_id ){
            $game->player[$user_id]->move(1);
            $game->view->append( "text", "ビリの" . $game->player[$user_id]->getName() . "が1マス進みました" );
        }
    }
}