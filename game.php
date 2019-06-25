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
        $this->advance = TRUE;

        $this->player[$this->turn_player]->yourTurn($this);

        $doBeforeRoll = new doBeforeRoll($this);
        $doBeforeRoll->index();

        $rollDice = new rollDice($this);
        $rollDice->rollPlayerTurn();

        $doAfterRoll = new doAfterRoll();
        $doAfterRoll->afterroll($this);
    }

    public function turnEnd(){
        $this->view->append( "title", "ターン終わり" );

        //イベント(ターンの終わり)
        $EventOccur = new EventOccur($this);
        $EventOccur->endTurn();

        $this->turn++;
    }

    public function show( $array_texts )
    {
        foreach ( $array_texts as $key => $value ){
            echo $value;
        }
    }
}
