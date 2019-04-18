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
        $this->board[] = $board;
    }
    
    public function addPlayer( $player )
    {
        $this->player[] = $player;    
    }

    public function setDice( $dice )
    {
        $this->dice = $dice;
    }
    
    public function start()
    {
        $this->match();
        $this->turn = 1;
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
                
                if ( $this->player[$i]->place > $this->board[0]->length )
                {
                    $this->end( $this->player[$i]->name );
                }
            }
            
            $this->turn++;
        }
    }
    
    public function end( $name )
    {
        echo $name . "のかち!" . PHP_EOL;
        exit;
    }
}