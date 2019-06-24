<?php
class Moreprogress
{
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $rollDice = new rollDice($this->game);
        $rollDice->progress();
    }

    public function turn_end(){

    }
}