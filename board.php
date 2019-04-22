<?php
class Board
{
    //コンストラクタ
    public function __construct($csv){
        $file = new SplFileObject( $csv ); 
        $file->setFlags(SplFileObject::READ_CSV); 
        foreach ($file as $line) {
            $map[] = $line[0];
            if( $line[0] == "goal" )
            {
                break;
            }
        }
        $this->map = $map; 
    }
}
