<?php
class Rest
{
    private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $game->player[$game->turn_player]->rest++;
        echo "1回休みです";
    }

    public function turn_end(){

    }
}
