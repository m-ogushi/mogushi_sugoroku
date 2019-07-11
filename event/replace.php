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
        } while ( $game->player[$replace_oppoment] == $game->getMovingPlayer() );

        $my_place = $game->getMovingPlayer()->getPlace();
        $oppoment_place = $game->player[$replace_oppoment]->getPlace();

        $game->getMovingPlayer()->setPlace($oppoment_place);
        $game->player[$replace_oppoment]->setPlace($my_place);
        $game->view->append( "text", $game->getMovingPlayer()->getName()  . "と" . $game->player[$replace_oppoment]->getName()  . "が入れ替わりました" );
    }

    public function turn_end($game){

    }
}
