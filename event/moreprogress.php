<?php
class Moreprogress
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $game->player[$game->turn_player]->rollDice($game);
    }

    public function turn_end($game){
    }
}