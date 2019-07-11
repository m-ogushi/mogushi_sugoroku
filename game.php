<?php
class Game
{
    private static $game;

    private $turn;
    private $turn_player;
    private $game_status;

    public static function getInstance()
    {
        if( !isset($game) )
        {
            $game = new Game();
        }
        return $game;
    }
    
    public function setBoard(BoardInterface $board )
    {
        $this->board = $board;
    }
    
    public function addPlayer(PlayerInterface $player )
    {
        $this->player[] = $player;    
    }

    public function addDice(DiceInterface $dice )
    {
        $this->dice[] = $dice;
    }

    public function setView(ViewInterface $view )
    {
        $this->view = $view;
    }
    
    public function start()
    {
        $this->turn = 1;
        $this->match();
    }

    private function match()
    {
        
        while ( true )
        {
            $this->turnStart();
            for ( $i = 0; $i < count( $this->player ); $i++ ) {
                $this->turn_player = $i;
                $this->eachPlayerMove();
            }
            $this->turnEnd();
        }
    }

    private function turnStart()
    {
        $this->view->append( "title", $this->turn . "ターン目です" );
        $this->game_status = "player";
    }

    private function eachPlayerMove()
    {
        $player = $this->getMovingPlayer();
        $this->view->append( "title", $player->getName() . "の番です" );

        $this->getMovingPlayer()->beforeRollDice($this);

        $this->getMovingPlayer()->rollDice($this);
        $this->checkAllPlayerStayIfCheckIn();

        $this->playerEvent();
        $this->checkAllPlayerStayIfCheckIn();

        $this->view->append( "title", $player->getPlace() . "マス目にいます" );

        $this->checkGoalOrNot();
    }

    private function checkAllPlayerStayIfCheckIn()
    {
        for ($i = 0; $i < count($this->player); $i++) {
            $this->player[$i]->stayIfCheckIn($this);
        }
    }

    private function turnEnd()
    {
        $this->view->append( "title", "ターン終わり" );
        $this->game_status = "turn_end";

        $this->turnEndEvent();
        $this->checkAllPlayerStayIfCheckIn();

        $this->turn++;
    }

    private function playerEvent()
    {
        if ( $this->getMovingPlayer()->getThisTurnMoveOrNot() )
        {
            $this->eventOccur($this->board->getEventNameFromPlace($this->getMovingPlayer()->getPlace()));
        }
    }

    private function turnEndEvent()
    {
        for ( $i = 0; $i < count( $this->player ); $i++ ) {
            $turn_end_event_names[] = $this->board->getEventNameFromPlace($this->player[$i]->getPlace());
        }
        foreach ( $turn_end_event_names as $value ) {
            $this->eventOccur($value);
        }
    }

    private function eventOccur($event_name)
    {
        $game_status = $this->game_status;
        $event = getOccurEvent::build($event_name);
        $event->$game_status($this);
    }

    private function checkGoalOrNot()
    {
        if ($this->getMovingPlayer()->checkGoalOrNot($this)) {
            $this->goalAndEnd($this->getMovingPlayer());
        }
    }

    private function goalAndEnd($goal_player)
    {
        $this->view->append( "text", $goal_player->getName() . "のかち!");
        //$this->view->html()->show($this);
        exit;
    }

    public function getMovingPlayer()
    {
        return $this->player[$this->turn_player];
    }
}
