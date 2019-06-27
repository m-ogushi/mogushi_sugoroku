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

    public function yourTurn() {
        echo 'あなたの番だからこそ';
        $this->advance = TRUE;
        $this->checkRest();
        $this->checkInCheckPoint();

    }

    public function checkRest()
    {
        if ( $this->rest > 0 ) {
            $this->rest--;
            $this->advance = FALSE;
            //$game->view->append("text", $game->player[$game->turn_player]->name."は休みです");
            echo $this->name . "は休みです";
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
}
