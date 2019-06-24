<?php

class doBeforeRoll
{
    public function __construct( $game )
    {
        $this->game = $game;
    }

    public function index()
    {
        $game = $this->game;
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
        if ( $this->termPassCheckPoint() ) {
            $game->player[$game->turn_player]->check_in = false;
            array_shift($game->player[$game->turn_player]->not_checked);
        }
    }

    public function termPassCheckPoint()
    {
        $game = $this->game;
        if ( in_array(mt_rand($game->dice[0]->min, $game->dice[0]->max), [1, 2]) ){
            $game->view->append("text", "これから進めます！");
            return TRUE;
        } else {
            $game->view->append("text", "まだ進めません");
        }
    }
}