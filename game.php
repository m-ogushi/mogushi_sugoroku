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
               
                if ( $this->player[$i]->rest > 0 )
                {
                    $this->player[$i]->rest--;
                    echo $this->player[$i]->name . 'は休みです' . PHP_EOL;
                }
                else
                { 
                    $this->progress( $this->player[$i] );
                    echo $this->player[$i]->place . "マス目にいます" . PHP_EOL;
                    $this->event( $this->player[$i], $this->board, $this->player );
                } 

                if ( $this->player[$i]->place > count( $this->board->map ) )
                {
                    $this->end( $this->player[$i]->name );
                }
            }
            
            $this->turn++;
        }
    }

    public function progress( $player )
    {
        $step = mt_rand( $this->dice->min, $this->dice->max);
        $player->place += $step;
        echo $step . "マス進みました";
    }
    
    public function event( $player, $board, $all_players )
    {
        switch ( $board->map[$player->place] ) {
            case "reprogress":
                $this->progress( $player );
		break;
            case "goadvance01":
                new Goadvance01( $player );
		break;
            case "goadvance02":
                new Goadvance02( $player );
		break;
            case "goadvance03":
                new Goadvance03( $player );
                break;
            case "goback01":
                new Goback01( $player );
                break;
            case "goback02":
                new Goback02( $player );
                break;
            case "goback03":
                new Goback03( $player );
                break;
            case "gostart":
                new Gostart( $player );
                break;
            case "rest":
                new rest( $player );
                break;
            case "replace":
                new replace( $player, $all_players );
                break;
            default:
                break;
        }
    }
 
    public function end( $name )
    {
        echo $name . "のかち!" . PHP_EOL;
        exit;
    }
}
