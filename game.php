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
            echo PHP_EOL . $this->turn . "ターン目です";
            $this->trun_event = [];
            for ( $i = 0; $i < count( $this->player ); $i++ )
            {
                echo PHP_EOL . $this->player[$i]->name . 'の番です';
                $this->turn_player = $i;
                //「休み」の判定
                if ( $this->player[$i]->rest > 0 )
                {
                    $this->player[$i]->rest--;
                    echo $this->player[$i]->name . 'は休みです';
                }
                else {
                    //チェックポイントの判定
                    if ( $this->player[$i]->check_in == TRUE ) {
                        echo 'チェックポイントにいます';
                        if ( in_array( mt_rand( $this->dice[0]->min, $this->dice[0]->max ), array(1, 2) ) ) {
                            echo 'これから進めます！';
                            $this->player[$i]->check_in = FALSE;
                            array_shift($this->player[$i]->not_checked );
                        }else{
                            echo 'まだ進めません';
                        }

                    }
                    //通常通り進む
                    else {
                        //サイコロを振って進む
                        $name = "diceprogress";
                        $Class = new $name( $this );
                        $Class->player();

                        //チェックマス判定
                        $this->check();
                        echo $this->player[$i]->place . "マス目にいます";

                        //イベント(プレイヤー毎)
                        $this->event_type = "player";
                        $this->event();

                        //チェックマス判定
                        $this->check();

                        //ゴールの判定
                        if ( $this->player[$i]->place >= count( $this->board->map ) ) {
                            $this->end( $this->player[$i]->name );
                        }
                    }
                }
            }

            echo PHP_EOL . 'ターン終わり ';
            //イベント(ターンの終わり)
            $this->event_type = "turn_end";
            $this->event();

            //チェックマス判定
            $this->check();
            $this->turn++;
        }
    }

    public function event()
    {
        $event_type = $this->event_type;

        switch ( $event_type ) {
            case "player":
                $event_name = $this->board->map[$this->player[$this->turn_player]->place];
                if ( !empty( $event_name ) ) {
                    $Class = new $event_name( $this );
                    $Class->$event_type();
                }
                break;
            case "turn_end":
                for ( $i = 0; $i < count( $this->player ); $i++ ) {
                    $event_names[] = $this->board->map[$this->player[$i]->place];
                }
                foreach ( $event_names as $event_name ) {
                    if ( !empty( $event_name ) ) {
                        $Class = new $event_name( $this );
                        $Class->$event_type();
                    }
                }
                break;
            default:
                break;
        }

    }

    public function check()
    {
        for ( $i = 0; $i < count( $this->player ); $i++ )
        {
            if ( !empty( $this->player[$i]->not_checked ) ){
                $next_check_place = min( $this->player[$i]->not_checked );
                if ( $next_check_place <= $this->player[$i]->place ) {
                    if ( $next_check_place < $this->player[$i]->place ){
                        echo $this->player[$i]->name . 'さんは' . $next_check_place . 'マス目のチェックポイントでとまります';
                    }
                    $this->player[$i]->check_in = TRUE;
                    $this->player[$i]->place = $next_check_place;
                }else{
                    $this->player[$i]->check_in = FALSE;
                }

            }
        }
    }
 
    public function end( $name )
    {
        echo $name . "のかち!" . PHP_EOL;
        exit;
    }
}
