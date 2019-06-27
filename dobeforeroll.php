<?php

class doBeforeRoll
{
    // いまはいらない
    public $game;
    public function __construct( $game )
    {
        $this->game = $game;
    }

    public function index()
    {
        $game = $this->game;
        $game->advance = TRUE;
        $this->checkRest();
        $this->checkInCheckPoint();
    }

    public function checkRest()
    {
        $game = $this->game;
        if ($this->TermRest() ) {
            $game->player[$game->turn_player]->rest--;
            $game->advance = FALSE;
            $game->view->append("text", $game->player[$game->turn_player]->name."は休みです");
            echo 'ぐっすり';
        }
    }

    public function termRest()
    {
        $game = $this->game;
        if ( $game->player[$game->turn_player]->rest > 0 ){
            return TRUE;
        }
    }

    public function checkInCheckPoint()
    {
        $game = $this->game;
        if ($game->player[$game->turn_player]->check_in == true) {
            $game->advance = FALSE;
            $game->view->append("text", "チェックポイントにいます");
            $this->tryPassCheckPoint();
        }
    }

    public function tryPassCheckPoint()
    {
        $game = $this->game;
        if ( in_array(mt_rand($game->dice[0]->min, $game->dice[0]->max), [1, 2]) ) {
            $game->player[$game->turn_player]->check_in = false;
            array_shift($game->player[$game->turn_player]->not_checked);
            $game->view->append("text", "これから進めます！");
        } else {
            $game->view->append("text", "まだ進めません");
        }
    }
}