<?php

class CommonUtility
{
    public static function getFirstCombinationInArray( $array )
    {
        $first_combination = ( array_slice( $array, 0, 1, true ) );
        $second_combination = ( array_slice( $array, 1, 1, true )  );

        if ( reset( $first_combination ) != reset( $second_combination ) ) {
            return $first_combination;
        } else {
            return;
        }
    }
}