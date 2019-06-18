<?php

class doBeforeRoll
{
    public static function checkrest($game)
    {
        if ($game->player[$game->turn_player]->rest > 0) {
            $game->player[$game->turn_player]->rest--;
            $game->view->append("text", $game->player[$game->turn_player]->name."は休みです");

            return;
        }

        if ($game->player[$game->turn_player]->check_in == true) {
            $game->view->append("text", "チェックポイントにいます");
            if (in_array(mt_rand($game->dice[0]->min, $game->dice[0]->max), [1, 2])) {
                $game->view->append("text", "これから進めます！");
                $game->player[$game->turn_player]->check_in = false;
                array_shift($game->player[$game->turn_player]->not_checked);
            } else {
                $game->view->append("text", "まだ進めません");
            }
            return;
        }

        $game->advance = 1;

        return;
    }
}