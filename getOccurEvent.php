<?php

class getOccurEvent
{
    //コンストラクタ
    public function __construct ()
    {
    }

    public static function build ( $event_name )
    {
        if ( ! empty( $event_name ) ) {
            return $Class = new $event_name();
        } else {
            return $Class = new noEvent();
        }
    }
}