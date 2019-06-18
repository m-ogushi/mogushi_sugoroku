<?php

class PlayerGoal
{
    public function judge($game)
    {
        if ($game->player[$game->turn_player]->place >= count($game->board->map)) {
            $this->end($game);
        }
    }

    public function end($game)
    {
        $game->view->append("title", $game->player[$game->turn_player]->name."のかち!");
        $html = $game->view->html();
        //$game->show( $html );
        exit;
    }
}