<?php
class Goback03 implements EventInterface
{
    private $game;
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->getMovingPlayer()->move(-3);
        $game->view->append( "text", "3マス戻りました" );
    }

    public function turn_end($game){

    }
}
