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
                $this->advance = 0;
                //「休み」の判定
                //if ( $this->player[$i]->rest > 0 ){
                //    $this->player[$i]->rest--;
                //    $this->view->append( "text", $this->player[$i]->name . "は休みです" );
                //} else {
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
                        StopCheckSquare::backIfNotChecked($this);
                        $this->view->append( "text", $this->player[$i]->place . "マス目にいます" );

                        //イベント(プレイヤー毎)
                        $this->event_type = "player";
                        $EventOccur = new EventOccur();
                        $EventOccur->index($this);

                        //チェックマス判定
                        StopCheckSquare::backIfNotChecked($this);

                        //ゴールの判定
                        $PlayerGoal = new PlayerGoal();
                        $PlayerGoal->judge($this);
                    }
                //}
            }

            $this->view->append( "title", "ターン終わり" );

            //イベント(ターンの終わり)
            $this->event_type = "turn_end";
            $EventOccur->index($this);

            //チェックマス判定
            StopCheckSquare::backIfNotChecked($this);
            $this->turn++;
        }
    }

    public function checkrest( $game ){
        if ( $game->player[$game->turn_player]->rest > 0 ){
            $game->player[$game->turn_player]->rest--;
            $game->view->append( "text", $this->player[$game->turn_player]->name . "は休みです" );
            exit;
        }

        if ( $this->player[$game->turn_player]->check_in == TRUE ){
            $game->view->append( "text", "チェックポイントにいます" );
            if ( in_array( mt_rand( $game->dice[0]->min, $game->dice[0]->max ), array(1, 2) ) ){
                $game->view->append( "text", "これから進めます！" );
                $game->player[$game->turn_player]->check_in = FALSE;
                array_shift($game->player[$game->turn_player]->not_checked );
            } else {
                $game->view->append( "text", "まだ進めません" );
            }
            exit;
        }

        $game->advance = 1;

    }

    public function show( $array_texts )
    {
        foreach ( $array_texts as $key => $value ){
            echo $value;
        }
    }
}
