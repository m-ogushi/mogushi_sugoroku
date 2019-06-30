<?php
class Moreprogress
{
    //コンストラクタ
    public function __construct(){
    }

    public function player($game){
        $rollDice = new rollDice($game);
        $rollDice->progress();
    }

    public function turn_end($game){
    }
}