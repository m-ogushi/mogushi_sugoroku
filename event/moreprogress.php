<?php
class Moreprogress
{
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $diceProgress = new diceprogress($this->game);
        $diceProgress->progress();
    }

    public function turn_end(){

    }
}