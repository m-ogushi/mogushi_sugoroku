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
    
    public function addPlayer( $player )
    {
        $this->player[] = $player;    
    }

    public function setDice( $dice )
    {
        $this->dice[] = $dice;
    }

    public function setView( $view )
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
        $this->trun_event = [];
    }

    private function eachPlayerTurn()
    {
        $player = $this->player[$this->turn_player];
        $this->view->append( "title", $player->name . "の番です" );

        $player->beforeRollDice($this);

        $player->rollDice($this);
        $this->checkAllPlayerStayIfCheckIn();

        $player->playerEvent($this);
        $this->checkAllPlayerStayIfCheckIn();

        $this->view->append( "title", $player->place . "マス目にいます" );


        if ( $player->Goal($this) ){
            $this->goalAndEnd($player);
        }
    }

    private function checkAllPlayerStayIfCheckIn()
    {
        for ($i = 0; $i < count($this->player); $i++) {
            //echo $this->player[$i]->name."をチェックします!"."\n";
            $this->player[$i]->stayIfCheckIn($this);
        }
    }

    private function turnEnd()
    {
        $this->view->append( "title", "ターン終わり" );

        $this->turnEndEvent();
        $this->checkAllPlayerStayIfCheckIn();

        $this->turn++;
    }

    private function turnEndEvent()
    {
        for ( $i = 0; $i < count( $this->player ); $i++ ) {
            $turn_end_event_names[] = $this->board->map[$this->player[$i]->place];
        }
        foreach ( $turn_end_event_names as $value ) {
            $event = EventOccur2::build($value);
            $event->turn_end($this);
        }
    }

    private function goalAndEnd($goal_player)
    {
        $this->view->append( "text", $goal_player->name."のかち!");
        $this->view->html()->show($this);
        exit;
    }
}
