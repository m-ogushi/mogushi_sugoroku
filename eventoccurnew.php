<?php
class EventOccur
{

    //private $game;
    //コンストラクタ
    public function __construct( ){
    }

    public static function build($place)
    {
        if (!empty($place)) {
            return $Class = new $place();
        } else {
            return $Class = new noEvent();
        }
    }
}