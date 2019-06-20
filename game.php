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
            $this->view->append( "title", $this->turn . "ターン目です" );
            $this->trun_event = [];
            for ( $i = 0; $i < count( $this->player ); $i++ ) {
                $this->view->append( "title", $this->player[$i]->name . "の番です" );
                $this->turn_player = $i;
                $this->advance = FALSE;

                $doBeforeRoll = new doBeforeRoll();
                $doBeforeRoll->checkrest($this);

                $diceProgress = new diceprogress($this);
                $diceProgress->roll();

                $doAfterRoll = new doAfterRoll();
                $doAfterRoll->afterroll($this);
            }

            $this->view->append( "title", "ターン終わり" );

            //イベント(ターンの終わり)
            $this->event_type = "turn_end";
            $EventOccur = new EventOccur();
            $EventOccur->index($this);

            $this->turn++;
        }
    }

    public function show( $array_texts )
    {
        foreach ( $array_texts as $key => $value ){
            echo $value;
        }
    }
}
