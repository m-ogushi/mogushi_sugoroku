<?php
class Player
{
    //コンストラクタ
    public function __construct( $player, $board )
    {
        $this->name  = $player;
        $this->place = 0;
        $this->rest = 0;
        $this->check_in = FALSE;
        $this->not_checked = $board->check_place;
    }

    public function beforeRollDice($game) {
        $this->this_turn_advance = TRUE;
        $this->checkRest($game);
        $this->checkInCheckPoint($game);

    }

    public function checkRest($game)
    {
        if ( $this->rest > 0 ) {
            $this->rest--;
            $this->this_turn_advance = FALSE;
            $game->view->append( "text", $this->name . "は休みです" );
        }
    }

    public function checkInCheckPoint($game)
    {
        if ($this->check_in == true) {
            $this->this_turn_advance = FALSE;
            $game->view->append("text", "チェックポイントにいます");
            //echo "チェックポイントにいます";
            $this->tryPassCheckPoint($game);
        }
    }

    public function tryPassCheckPoint($game)
    {
        if ( in_array($game->dice[0]->roll($game), [1, 2]) ) {
            $this->check_in = false;
            array_shift($this->not_checked);
           // $game->view->append("text", "これから進めます！");
            $game->view->append( "text", "これからすすめます" );
        } else {
           // $game->view->append("text", "まだ進めません");
            $game->view->append( "text", "まだ進めません" );
        }
    }

    public function rollDice($game)
    {
        if ($this->this_turn_advance == TRUE) {
            $steps = 0;
            for ($i = 0; $i < count($game->dice); $i++) {
                $step = $game->dice[$i]->roll($game);
                $steps += $step;
            }
            $this->place += $steps;
            $game->view->append( "text", $steps . "マス進みます" );
        }
    }

    public function stayIfCheckIn($game)
    {
        if ( !empty($this->not_checked) ) {
            $next_check_place = min($this->not_checked);
            if ($next_check_place <= $this->place) {
                //TODO このif文を外して良いかどうかテスト(場所が変わったときに、必要)
                if ($next_check_place < $this->place) {
                    $game->view->append("text", $this->name.'さんは'.$next_check_place.'マス目のチェックポイントでとまります');
                }
                $this->check_in = true;
                $this->place = $next_check_place;
            } else {
                $this->check_in = false;
            }
        }
    }

    public function playerEvent($game)
    {
        if( $this->this_turn_advance == TRUE ) {
            $event = EventOccur2::build($game->board->map[$this->place]);
            $event->player($game);
        }
    }

    public function Goal($game)
    {
        return ( $this->place >= count( $game->board->map) ) ? TRUE: FALSE;
    }
}
