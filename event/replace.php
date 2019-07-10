<?php
class Replace implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        do{
            $replace_oppoment = mt_rand( 0, count( $game->player ) - 1 );
        } while ( $game->player[$replace_oppoment] == $game->player[$game->turn_player] );

        $my_place = $game->player[$game->turn_player]->getPlace();
        $oppoment_place = $game->player[$replace_oppoment]->getPlace();

        $game->player[$game->turn_player]->setPlace($oppoment_place);
        $game->player[$replace_oppoment]->setPlace($my_place);
        $game->view->append( "text", $game->player[$game->turn_player]->name . "さんと" . $game->player[$replace_oppoment]->name . "さんが入れ替わりました" );
    }

    public function turn_end($game){

    }
}
