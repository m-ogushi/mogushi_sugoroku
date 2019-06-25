<?php
class EventOccur
{

    //private $game;
    //コンストラクタ
    public function __construct( $game ){
        $this->game = $game;
    }
    //}

    public function playerTurn()
    {
        $game = $this->game;
        $event_name = $game->board->map[$game->player[$game->turn_player]->place];
        if (!empty($event_name)) {
            $Class = new $event_name($game);
            $Class->player();
        }
        $StopCheckSquare = new StopCheckSquare($game);
        $StopCheckSquare->stayIfNotChecked();
    }

    public function endTurn()
    {
        $game = $this->game;
        for ($i = 0; $i < count($game->player); $i++) {
            $event_names[] = $game->board->map[$game->player[$i]->place];
        }
        foreach ($event_names as $event_name) {
            if (!empty($event_name)) {
                $Class = new $event_name($game);
                $Class->turn_end();
            }
        }
        $StopCheckSquare = new StopCheckSquare($game);
        $StopCheckSquare->stayIfNotChecked();
    }
}