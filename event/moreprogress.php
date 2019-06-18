<?php
class Moreprogress
{
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }

    public function player(){
        $game = $this->game;
        $steps = 0;
        for ( $i = 0; $i < count( $game->dice ); $i++ ){
            $step = mt_rand( $game->dice[$i]->min, $game->dice[$i]->max );
            $steps += $step;
        }
        $game->player[$game->turn_player]->place += $steps;
        $game->view->append( "text", $steps . "マス進みます" );
    }

    public function turn_end(){

    }
}