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

    public function turnStart(){
        $this->view->append( "title", $this->turn . "ターン目です" );
        $this->trun_event = [];
    }

    public function eachPlayerTurn() {
        $this->view->append( "title", $this->player[$this->turn_player]->name . "の番です" );
        echo $this->player[$this->turn_player]->name . "の番です" ."\n";
        //$this->advance = TRUE;

        $this->player[$this->turn_player]->yourTurn();

        //$doBeforeRoll = new doBeforeRoll($this);
        //$doBeforeRoll->index();

        $this->player[$this->turn_player]->diceProgress($this);

        for ($i = 0; $i < count($this>player); $i++) {
            $this->player[$i]->stayIfNotChecked();
        }

        //$rollDice = new rollDice($this);
        //$rollDice->rollPlayerTurn();

        //$this->player[$this->turn_player]->event($this);

        $event = EventOccur2::build($this->board->map[$this->player[$this->turn_player]->place]);
        $event->player($this);

        for ($i = 0; $i < count($this->player); $i++) {
            echo $this->player[$i]->name."をチェックします!"."\n";
            $this->player[$i]->stayIfNotChecked();
        }

        echo $this->player[$this->turn_player]->place . "マス目にいます"."\n";

        if ($this->player[$this->turn_player]->place >= count($this->board->map)) {
            //$game->view->append("title", $game->player[$game->turn_player]->name."のかち!");
            echo $this->player[$this->turn_player]->name."のかち!";
            exit;
        }

        //$doAfterRoll = new doAfterRoll();
        //$doAfterRoll->afterroll($this);
    }

    public function turnEnd(){
        $this->view->append( "title", "ターン終わり" );

        //イベント(ターンの終わり)
        //$EventOccur = new EventOccur($this);
        //$EventOccur->endTurn();

        for ($i = 0; $i < count($this>player); $i++) {
            $event = EventOccur2::build($this->board->map[$this->player[$i]->place]);
            $event->turn_end($this);
        }

        for ($i = 0; $i < count($this>player); $i++) {
            $this->player[$i]->stayIfNotChecked();
        }

        $this->turn++;
    }

    public function show( $array_texts )
    {
        foreach ( $array_texts as $key => $value ){
            echo $value;
        }
    }
}
