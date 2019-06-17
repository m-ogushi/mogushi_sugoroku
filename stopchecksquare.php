<?php

class StopCheckSquare
{
    public static function index($game)
    {
        for ($i = 0; $i < count($game->player); $i++) {
            if (! empty($game->player[$i]->not_checked)) {
                $next_check_place = min($game->player[$i]->not_checked);
                if ($next_check_place <= $game->player[$i]->place) {
                    if ($next_check_place < $game->player[$i]->place) {
                        $game->view->append("text", $game->player[$i]->name.'さんは'.$next_check_place.'マス目のチェックポイントでとまります');
                    }
                    $game->player[$i]->check_in = true;
                    $game->player[$i]->place = $next_check_place;
                } else {
                    $game->player[$i]->check_in = false;
                }
            }
        }
    }
}