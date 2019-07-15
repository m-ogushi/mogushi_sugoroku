<?php
class Dice implements DiceInterface
{
    private $min;
    private $max;

    //コンストラクタ
    public function __construct( $faces )
    {
        $this->min = 1;
        $this->max = $faces;
    }

    public function roll(Game $game)
    {
        $result = mt_rand( $this->min, $this->max );
        $game->view->append( "text", $result . "の目が出た" );

        return $result;
    }
}
