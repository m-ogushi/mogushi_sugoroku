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
        $this->dice = $dice;
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
            echo $this->turn . "ターン目です" . PHP_EOL;
            for ( $i = 0; $i < count( $this->player ); $i++ )
            {
                echo $this->player[$i]->name . 'の番です';
                
                $this->player[$i]->place += mt_rand( $this->dice->min, $this->dice->max);
                echo $this->player[$i]->place . "マス目にいます" . PHP_EOL;

                $this->event( $this->player[$i], $this->board );
                echo $this->player[$i]->place . "マス目にいます" . PHP_EOL;
                
                if ( $this->player[$i]->place > 50 /*$this->board->goal*/ )
                {
                    $this->end( $this->player[$i]->name );
                }
            }
            
            $this->turn++;
        }
    }
    
    public function event( $player, $board )
    {

        if( $player->place == $board->goadvance01 )
        {
            new Goadvance( $player, 1 );
	} 
        if( $player->place == $board->goadvance02 )
        {
            new Goadvance( $player, 2 );
	} 
        if( $player->place == $board->goadvance03 )
        {
            new Goadvance( $player, 3 );
	} 

        if( $player->place == $board->goback01 )
        {
            new Goback( $player, 1 );
	} 
        if( $player->place == $board->goback02 )
        {
            new Goback( $player, 2 );
	} 
        if( $player->place == $board->goback03 )
        {
            new Goback( $player, 3 );
	} 
    }
 
    public function end( $name )
    {
        echo $name . "のかち!" . PHP_EOL;
        exit;
    }
}
