<?php

class doAfterRoll
{
    public function afterroll($game)
    {
        if ($game->advance == true) {
            //イベント(プレイヤー毎)
            $EventOccur = new EventOccur($game);
            $EventOccur->playerTurn();

            //ゴールの判定
            $PlayerGoal = new PlayerGoal();
            $PlayerGoal->judge($game);
        }
    }
}