<?php

class Game
{
    private static $game;
    private $turn;
    private $turn_player;
    public $board;
    public $player;
    public $dice;
    public $view;
    private $event;

    public static function getInstance ()
    {
        if ( ! isset( $game ) ) {
            $game = new Game();
        }

        return $game;
    }

    public function setBoard ( BoardInterface $board )
    {
        $this->board = $board;
    }

    public function addPlayer ( PlayerInterface $player )
    {
        $this->player[] = $player;
    }

    public function addDice ( DiceInterface $dice )
    {
        $this->dice[] = $dice;
    }

    public function setView ( ViewInterface $view )
    {
        $this->view = $view;
    }

    public function setEventType ( EventInterface $event )
    {
        $this->event = $event;
    }

    public function start ()
    {
        $this->turn = 0;
        $this->match();
    }

    private function match ()
    {

        while ( true ) {
            $this->turnStart();
            for ( $i = 0; $i < $this->numberOfAllPlayers(); $i++ ) {
                $this->turn_player = $i;
                $this->eachPlayerMove();
            }
            $this->turnEnd();
        }
    }

    private function turnStart ()
    {
        $this->turn++;
        $this->view->append( "title", $this->turn . "ターン目です" );
    }

    private function eachPlayerMove ()
    {
        $this->view->append( "title", $this->getMovingPlayer()->getName() . "の番です" );

        $this->getMovingPlayer()->beforeRollDice( $this );

        $this->getMovingPlayer()->rollDice( $this );
        $this->checkAllPlayerStayIfCheckIn();

        $this->event->player( $this );
        $this->checkAllPlayerStayIfCheckIn();

        $this->view->append( "title", $this->getMovingPlayer()->getPlace() . "マス目にいます" );

        $this->checkPlayerGoalOrNot();
    }

    private function checkAllPlayerStayIfCheckIn ()
    {
        for ( $i = 0; $i < $this->numberOfAllPlayers(); $i++ ) {
            $this->player[$i]->stayIfCheckIn( $this );
        }
    }

    private function turnEnd ()
    {
        $this->view->append( "title", "ターン終わり" );

        $this->event->turn_end( $this );
        $this->checkAllPlayerStayIfCheckIn();
    }

    private function checkPlayerGoalOrNot ()
    {
        if ( $this->getMovingPlayer()->checkGoalOrNot( $this ) ) {
            $this->goalAndEnd( $this->getMovingPlayer() );
        }
    }

    private function goalAndEnd ( $goal_player )
    {
        $this->view->append( "text", $goal_player->getName() . "のかち!" );
        $this->showGameHtml();
        exit;
    }

    private function showGameHtml ()
    {
        $this->view->html()->show( $this );
    }

    public function getMovingPlayer ()
    {
        return $this->player[$this->turn_player];
    }

    public function rollAllDice ()
    {
        $sum = 0;
        for ( $i = 0; $i < count( $this->dice ); $i++ ) {
            $roll_result = $this->dice[$i]->roll( $this );
            $sum += $roll_result;
        }
        return $sum;
    }

    public function numberOfAllPlayers ()
    {
        return count( $this->player );
    }

    public function getAllPlayerPlace ()
    {
        $player_place = [];
        for ( $i = 0; $i < $this->numberOfAllPlayers(); $i++ ) {
            $player_place[] += $this->player[$i]->getPlace();
        }
        return $player_place;
    }
}
