<?php

class doAfterRoll
{
    public function afterroll($game)
    {
        if ($game->advance == true) {
            //イベント(プレイヤー毎)
            $game->event_type = "player";
            $EventOccur = new EventOccur();
            $EventOccur->index($game);

            //ゴールの判定
            $PlayerGoal = new PlayerGoal();
            $PlayerGoal->judge($game);
        }
    }
}