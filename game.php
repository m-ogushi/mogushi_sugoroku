<?php
class Game
{
    private static $game;
    public static function getInstance()
    {
        if( !isset($game) )
        {
            $game = new Game();
        }
        return $game;
    }
    
    public function setBoard( $board )
    {
        $this->board = $board;
    }
    
    public function addPlayer(PlayerInterface $player )
    {
        $this->player[] = $player;    
    }

    public function setDice(DiceInterface $dice )
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

    public function match()
    {
        
        while ( true )
        {
            $this->turnStart();
            for ( $i = 0; $i < count( $this->player ); $i++ ) {
                $this->turn_player = $i;
                $this->eachPlayerTurn();
            }
            $this->turnEnd();
        }
    }

    private function turnStart()
    {
        $this->view->append( "title", $this->turn . "ターン目です" );
        $this->game_status = "player";
    }

    private function eachPlayerTurn()
    {
        $player = $this->player[$this->turn_player];
        $this->view->append( "title", $player->name . "の番です" );

        $player->beforeRollDice($this);

        $player->rollDice($this);
        $this->checkAllPlayerStayIfCheckIn();

        $this->playerEvent();
        $this->checkAllPlayerStayIfCheckIn();

        $this->view->append( "title", $player->place . "マス目にいます" );


        if ( $player->Goal($this) ){
            $this->goalAndEnd($player);
        }
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
        if ( $this->player[$this->turn_player]->getThisTurnMoveOrNot() )
        {
            $this->eventOccur($this->board->getMap($this->player[$this->turn_player]->getPlace()));
        }
    }
    private function turnEndEvent()
    {
        for ( $i = 0; $i < count( $this->player ); $i++ ) {
            $turn_end_event_names[] = $this->board->getMap($this->player[$i]->getPlace());
        }
        foreach ( $turn_end_event_names as $value ) {
            $this->eventOccur($value);
        }
    }

    private function eventOccur($event_name)
    {
        $game_status = $this->game_status;
        $event = EventOccur::build($event_name);
        $event->$game_status($this);
    }

    private function goalAndEnd($goal_player)
    {
        $this->view->append( "text", $goal_player->name."のかち!");
        //$this->view->html()->show($this);
        exit;
    }
}
