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
            for ( $i = 0; $i < count( $this->player ); $i++ ){
                $this->view->append( "title", $this->player[$i]->name . "の番です" );
                $this->turn_player = $i;
                //「休み」の判定
                if ( $this->player[$i]->rest > 0 ){
                    $this->player[$i]->rest--;
                    $this->view->append( "text", $this->player[$i]->name . "は休みです" );
                } else {
                    //チェックポイントの判定
                    if ( $this->player[$i]->check_in == TRUE ){
                        $this->view->append( "text", "チェックポイントにいます" );
                        if ( in_array( mt_rand( $this->dice[0]->min, $this->dice[0]->max ), array(1, 2) ) ){
                            $this->view->append( "text", "これから進めます！" );
                            $this->player[$i]->check_in = FALSE;
                            array_shift($this->player[$i]->not_checked );
                        } else {
                            $this->view->append( "text", "まだ進めません" );
                        }

                    } else {
                        //通常通り進む

                        //サイコロを振って進む
                        $name = "diceprogress";
                        $Class = new $name( $this );
                        $Class->player();

                        //チェックマス判定
                        StopCheckSquare::index($this);
                        $this->view->append( "text", $this->player[$i]->place . "マス目にいます" );

                        //イベント(プレイヤー毎)
                        $this->event_type = "player";
                        EventOccur::index($this);

                        //チェックマス判定
                        StopCheckSquare::index($this);

                        //ゴールの判定
                        if ( $this->player[$i]->place >= count( $this->board->map ) ){
                            $this->end( $this->player[$i]->name );
                        }
                    }
                }
            }

            $this->view->append( "title", "ターン終わり" );

            //イベント(ターンの終わり)
            $this->event_type = "turn_end";
            EventOccur::index($this);

            //チェックマス判定
            StopCheckSquare::index($this);
            $this->turn++;
        }
    }

    public function end( $name )
    {
        $this->view->append( "title", $name. "のかち!" );
        $html = $this->view->html();
        $this->show( $html );
        exit;
    }

    public function show( $array_texts )
    {
        foreach ( $array_texts as $key => $value ){
            echo $value;
        }
    }
}
