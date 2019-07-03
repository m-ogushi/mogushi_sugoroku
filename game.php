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
        echo $player->name . "の番です" ."\n";

        $player->beforeRollDice();

        $player->diceProgress($this);
        $this->checkAllPlayerStayIfNotChecked();

        $player->playerEvent($this);
        $this->checkAllPlayerStayIfNotChecked();

        echo $player->place . "マス目にいます"."\n";

        if ( $player->Goal($this) ){
            $this->goalAndEnd($player);
        }
    }

    private function checkAllPlayerStayIfNotChecked()
    {
        for ($i = 0; $i < count($this->player); $i++) {
            echo $this->player[$i]->name."をチェックします!"."\n";
            $this->player[$i]->stayIfNotChecked();
        }
    }

    private function turnEnd()
    {
        $this->view->append( "title", "ターン終わり" );

        $this->turnEndEvent();

        $this->checkAllPlayerStayIfNotChecked();

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
        echo $goal_player->name."のかち!";
        exit;
    }

    public function show( $array_texts )
    {
        foreach ( $array_texts as $key => $value ){
            echo $value;
        }
    }
}
