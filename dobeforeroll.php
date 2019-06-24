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
        $this->checkrest();
        $this->inCheckPointTreat();
    }

    public function checkrest()
    {
        $game = $this->game;
        if ($game->player[$game->turn_player]->rest > 0) {
            $game->player[$game->turn_player]->rest--;
            $game->advance = FALSE;
            $game->view->append("text", $game->player[$game->turn_player]->name."は休みです");
        }
    }

    public function inCheckPointTreat()
    {
        $game = $this->game;
        if ($game->player[$game->turn_player]->check_in == true) {
            $game->advance = FALSE;
            $game->view->append("text", "チェックポイントにいます");
            $this->getOutCheckPointOrNot();
        }
    }

    /**
     * @param $game
     */
    public function getOutCheckPointOrNot()
    {
        $game = $this->game;
        if (in_array(mt_rand($game->dice[0]->min, $game->dice[0]->max), [1, 2])) {
            $game->view->append("text", "これから進めます！");
            $game->player[$game->turn_player]->check_in = false;
            array_shift($game->player[$game->turn_player]->not_checked);
        } else {
            $game->view->append("text", "まだ進めません");
        }
    }
}