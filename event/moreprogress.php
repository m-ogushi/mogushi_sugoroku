<?php
class Moreprogress
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->player[$game->getTurnPlayer()]->rollDice($game);
    }

    public function turn_end($game){
    }
}