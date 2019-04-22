<?php
class replace
{
    //コンストラクタ
    public function __construct( $player, $all_players ){
        do{
             $replace_oppoment = mt_rand( 0, count( $all_players ) - 1 );
        } while ( $all_players[$replace_oppoment]->name == $player->name );

        $my_place = $player->place;
        $oppoment_place = $all_players[$replace_oppoment]->place;

        $player->place = $oppoment_place;
        $all_players[$replace_oppoment]->place = $my_place;
        echo $player->name . "さんと" . $all_players[$replace_oppoment]->name . "さんが入れ替わりました" . PHP_EOL;
    }
}
