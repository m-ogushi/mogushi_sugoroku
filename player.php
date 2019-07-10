<?php
class Player implements PlayerInterface
{
    //コンストラクタ
    public function __construct( $player, $game )
    {
        $this->name  = $player;
        $this->place = 0;
        $this->rest = 0;
        $this->check_in = FALSE;
        $this->not_checked = $game->board->check_place;
    }

    public function beforeRollDice($game) {
        $this->move_this_turn = TRUE;
        $this->checkRest($game);
        $this->checkInCheckPoint($game);

    }

    public function checkRest($game)
    {
        if ( $this->rest > 0 ) {
            $this->rest--;
            $this->move_this_turn = FALSE;
            $game->view->append( "text", $this->name . "は休みです" );
        }
    }

    public function checkInCheckPoint($game)
    {
        if ($this->check_in == true) {
            $this->move_this_turn = FALSE;
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
            $game->view->append( "text", "これからすすめます" );
        } else {
            $game->view->append( "text", "まだ進めません" );
        }
    }

    public function rollDice($game)
    {
        if ( $this->getThisTurnMoveOrNot() ) {
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

    public function Goal($game)
    {
        return ( $this->place >= count( $game->board->map) ) ? TRUE: FALSE;
    }

    public function move($forward_spaces)
    {
        $this->place += $forward_spaces;
    }

    public function addRestFlag()
    {
        $this->rest++;
    }

    public function backStart()
    {
        $this->place = 0;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function getThisTurnMoveOrNot()
    {
        return $this->move_this_turn;
    }
}
