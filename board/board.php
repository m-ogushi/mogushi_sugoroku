<?php

class Board implements BoardInterface
{
    private $map;
    private $check_place;

    //コンストラクタ
    public function __construct ( $csv )
    {
        $file = new SplFileObject( $csv );
        $file->setFlags( SplFileObject::READ_CSV );
        $i = 0;
        $check_place = [];
        foreach ( $file as $line ) {
            $map[] = $line[0];

            if ( $line[0] == "check" ) {
                $check_place[] = $i;
            }

            if ( $line[0] == "goal" ) {
                break;
            }
            $i++;
        }
        $this->map = $map;
        $this->check_place = $check_place;
    }

    public function getEventNameFromPlace ( $place )
    {
        if ( $place < $this->getMapLength() ) {
            return $this->map[$place];
        }
    }

    public function getMapLength ()
    {
        return count( $this->map );
    }

    public function getCheckPlace ()
    {
        return $this->check_place;
    }
}
