<?php

class rollDice
{
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }
    public function rollPlayerTurn()
    {
        $game = $this->game;
        if ($game->advance == true) {
            $this->progress();
            $StopCheckSquare = new StopCheckSquare($game);
            $StopCheckSquare->stayIfNotChecked();
            $game->view->append("text", $game->player[$game->turn_player]->place."マス目にいます");
        }
    }

    public function progress()
    {
        $game = $this->game;
        $steps = 0;
        for ( $i = 0; $i < count( $game->dice ); $i++ ){
            $step = mt_rand( $game->dice[$i]->min, $game->dice[$i]->max );
            $steps += $step;
        }
        $game->player[$game->turn_player]->place += $steps;
        $game->view->append( "text", $steps . "マス進みます" );
    }
}