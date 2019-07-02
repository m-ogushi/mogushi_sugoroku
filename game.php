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
    
    public function addEvent( $event )
    {
        $this->event = $event;
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

    public function turnStart()
    {
        $this->view->append( "title", $this->turn . "ターン目です" );
        $this->trun_event = [];
    }

    public function eachPlayerTurn()
    {
        $this->view->append( "title", $this->player[$this->turn_player]->name . "の番です" );
        echo $this->player[$this->turn_player]->name . "の番です" ."\n";
        //$this->advance = TRUE;

        $this->player[$this->turn_player]->beforeRoll();

        $this->player[$this->turn_player]->diceProgress($this);

        $this->checkAllPlayerStayIfNotChecked();

        $this->player[$this->turn_player]->playerEvent($this);

        $this->checkAllPlayerStayIfNotChecked();

        echo $this->player[$this->turn_player]->place . "マス目にいます"."\n";

        //if ($this->player[$this->turn_player]->place >= count($this->board->map)) {
        if ( $this->player[$this->turn_player]->playerGoal($this) ){
            //$game->view->append("title", $game->player[$game->turn_player]->name."のかち!");
            echo $this->player[$this->turn_player]->name."のかち!";
            exit;
        }
    }

    public function checkAllPlayerStayIfNotChecked()
    {
        for ($i = 0; $i < count($this->player); $i++) {
            echo $this->player[$i]->name."をチェックします!"."\n";
            $this->player[$i]->stayIfNotChecked();
        }
    }

    public function turnEnd()
    {
        $this->view->append( "title", "ターン終わり" );

        for ( $i = 0; $i < count( $this->player ); $i++ ) {
            $turn_end_event_names[] = $this->board->map[$this->player[$i]->place];
        }
        foreach ( $turn_end_event_names as $value ) {
            $event = EventOccur2::build($value);
            $event->turn_end($this);
        }

        $this->checkAllPlayerStayIfNotChecked();

        $this->turn++;
    }

    public function show( $array_texts )
    {
        foreach ( $array_texts as $key => $value ){
            echo $value;
        }
    }
}
