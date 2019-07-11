<?php
class Moreprogress
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->getMovingPlayer()->rollDice($game);
    }

    public function turn_end($game){
    }
}