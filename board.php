<?php
class Board
{
    //コンストラクタ
    public function __construct($csv){
        $file = new SplFileObject( $csv ); 
        $file->setFlags(SplFileObject::READ_CSV);
        $i = 0;
        $check_place = [];
        foreach ($file as $line){
            $map[] = $line[0];

            if ( $line[0] == "check" ){
                $check_place[] = $i;
            }

            if( $line[0] == "goal" ){
                break;
            }
            $i++;
        }
        $this->map = $map;
        $this->check_place = $check_place;
    }

    public function map(PlayerInterface $player)
    {
        return $this->map[$player->place];
    }
}
