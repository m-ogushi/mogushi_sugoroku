<?php

class Player implements PlayerInterface
{
    private $name;
    private $place;
    private $rest;
    private $check_in;
    private $not_checked;
    private $move_this_turn;

    //コンストラクタ
    public function __construct ( $player, $game )
    {
        $this->name = $player;
        $this->place = 0;
        $this->rest = 0;
        $this->check_in = false;
        $this->not_checked = $game->board->getCheckPlace();
        $this->move_this_turn = true;
    }

    public function beforeRollDice ( Game $game )
    {
        $this->move_this_turn = true;
        $this->checkRest( $game );
        $this->checkInCheckPoint( $game );
    }

    private function checkRest ( Game $game )
    {
        if ( $this->rest > 0 ) {
            $this->rest--;
            $this->move_this_turn = false;
            $game->view->append( "text", $this->name . "は休みです" );
        }
    }

    private function checkInCheckPoint ( Game $game )
    {
        if ( $this->check_in == true ) {
            $this->move_this_turn = false;
            $game->view->append( "text", "チェックポイントにいます" );
            $this->tryPassCheckPoint( $game );
        }
    }

    private function tryPassCheckPoint ( Game $game )
    {
        if ( in_array( $game->dice[0]->roll( $game ), [ 1, 2 ] ) ) {
            $this->check_in = false;
            array_shift( $this->not_checked );
            $game->view->append( "text", "これからすすめます" );
        } else {
            $game->view->append( "text", "まだ進めません" );
        }
    }

    public function rollDice ( Game $game )
    {
        if ( $this->getThisTurnMoveOrNot() ) {
            $steps = $game->rollAllDice();
            $this->place += $steps;
            $game->view->append( "text", $steps . "マス進みます" );
        }
    }

    public function stayIfCheckIn ( Game $game )
    {
        if ( ! empty( $this->not_checked ) ) {
            $next_check_place = min( $this->not_checked );
            if ( $next_check_place <= $this->place ) {
                if ( $next_check_place < $this->place ) {
                    $game->view->append( "text", $this->name . 'は' . $next_check_place . 'マス目のチェックポイントでとまります' );
                }
                $this->check_in = true;
                $this->place = $next_check_place;
            } else {
                $this->check_in = false;
            }
        }
    }

    public function checkGoalOrNot ( Game $game )
    {
        return ( $this->place >= $game->board->getMapLength() ) ? true : false;
    }

    public function move ( $forward_spaces )
    {
        $this->place += $forward_spaces;
    }

    public function addRestFlag ()
    {
        $this->rest++;
    }

    public function backStart ()
    {
        $this->place = 0;
    }

    public function getPlace ()
    {
        return $this->place;
    }

    public function setPlace ( $place )
    {
        $this->place = $place;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function getThisTurnMoveOrNot ()
    {
        return $this->move_this_turn;
    }
}
