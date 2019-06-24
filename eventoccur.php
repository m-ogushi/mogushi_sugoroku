<?php
class EventOccur
{

    //private $game;
    //コンストラクタ
    //public function __construct( $game ){
    //    $game->game = $game;
    //}

    public function index($game)
    {
        //これも分離
        if( count( $game->board->map ) <= $game->player[$game->turn_player]->place ){
            return;
        }

        $event_type = $game->event_type;

        switch ($event_type) {
            case "player":
                $event_name = $game->board->map[$game->player[$game->turn_player]->place];
                if (!empty($event_name)) {
                    $Class = new $event_name($game);
                    $Class->$event_type();
                }
                break;
            case "turn_end":
                for ($i = 0; $i < count($game->player); $i++) {
                    $event_names[] = $game->board->map[$game->player[$i]->place];
                }
                foreach ($event_names as $event_name) {
                    if (!empty($event_name)) {
                        $Class = new $event_name($game);
                        $Class->$event_type();
                    }
                }
                break;
            default:
                break;
        }
        $StopCheckSquare = new StopCheckSquare($game);
        $StopCheckSquare->stayIfNotChecked();
    }
}