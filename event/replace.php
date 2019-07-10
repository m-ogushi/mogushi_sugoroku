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
        } while ( $game->player[$replace_oppoment] == $game->player[$game->getTurnPlayer()] );

        $my_place = $game->player[$game->getTurnPlayer()]->getPlace();
        $oppoment_place = $game->player[$replace_oppoment]->getPlace();

        $game->player[$game->getTurnPlayer()]->setPlace($oppoment_place);
        $game->player[$replace_oppoment]->setPlace($my_place);
        $game->view->append( "text", $game->player[$game->getTurnPlayer()]->getName()  . "さんと" . $game->player[$replace_oppoment]->getName()  . "さんが入れ替わりました" );
    }

    public function turn_end($game){

    }
}
