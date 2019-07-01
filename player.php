<?php
class Player
{
    //コンストラクタ
    public function __construct( $player, $board )
    {
        $this->name  = $player;
        $this->place = 0;
        $this->rest = 0;
        $this->check_in = FALSE;
        $this->not_checked = $board->check_place;
    }

    public function beforeRoll() {
        echo 'あなたの番だからこそ';
        $this->advance = TRUE;
        $this->checkRest();
        $this->checkInCheckPoint();

    }

    public function checkRest()
    {
        if ( $this->rest > 0 ) {
            echo $this->rest;
            $this->rest--;
            $this->advance = FALSE;
            //$game->view->append("text", $game->player[$game->turn_player]->name."は休みです");
            echo $this->name . "は休みです";
            echo $this->rest;
        }
    }

    public function checkInCheckPoint()
    {
        if ($this->check_in == true) {
            $this->advance = FALSE;
            //$game->view->append("text", "チェックポイントにいます");
            echo "チェックポイントにいます";
            $this->tryPassCheckPoint();
        }
    }

    public function tryPassCheckPoint()
    {
        if ( in_array(mt_rand(/*$game->dice[0]->min, $game->dice[0]->max)*/0,6), [1, 2]) ) {
            $this->check_in = false;
            array_shift($this->not_checked);
           // $game->view->append("text", "これから進めます！");
            echo "これからすすめます";
        } else {
           // $game->view->append("text", "まだ進めません");
            echo "まだすすめません";
        }
    }

    public function diceProgress($game)
    {
        $steps = 0;
        for ($i = 0; $i < count($game->dice); $i++) {
            $step = $game->dice[$i]->roll();
            $steps += $step;
        }
        $this->place += $steps;
        //$game->view->append( "text", $steps . "マス進みます" );
        echo $steps . "マス進みます";
    }

    public function stayIfNotChecked()
    {
        //for ($i = 0; $i < count($game->player); $i++) {
            if (! empty($this->not_checked)) {
                $next_check_place = min($this->not_checked);
                if ($next_check_place <= $this->place) {
                    //TODO このif文を外して良いかどうかテスト(場所が変わったときに、必要)
                    if ($next_check_place < $this->place) {
                        //$game->view->append("text", $this->name.'さんは'.$next_check_place.'マス目のチェックポイントでとまります');
                    }
                    $this->check_in = true;
                    $this->place = $next_check_place;
                } else {
                    $this->check_in = false;
                }
            }
        //}
    }

    public function playerEvent($game)
    {
        if( $this->advance == TRUE ) {
            $event = EventOccur2::build($game->board->map[$this->place]);
            $event->player($game);
        }
    }

    public function playerGoal($game)
    {
        return ( $this->place >= count($game->board->map) ) ? TRUE: FALSE;
    }
}
