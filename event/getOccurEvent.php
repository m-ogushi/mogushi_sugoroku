<?php

class getOccurEvent implements EventInterface
{
    public function player ( Game $game )
    {
        if ( $game->getMovingPlayer()->getThisTurnMoveOrNot() ) {
            $event = $this->get( $game->board->getEventNameFromPlace( $game->getMovingPlayer()->getPlace() ) );
            if ( $event instanceof EventInterface ) {
                $event->player( $game );
            }
        }
    }

    public function turn_end ( Game $game )
    {
        $turn_end_event_names = [];
        for ( $i = 0; $i < $game->numberOfAllPlayers(); $i++ ) {
            $turn_end_event_names[] = $game->board->getEventNameFromPlace( $game->player[$i]->getPlace() );
        }
        foreach ( $turn_end_event_names as $value ) {
            $event = $this->get( $value );
            $game->view->append( "text", $value . "です" );
            if ( $event instanceof EventInterface ) {
                $event->turn_end( $game );
            }
        }
    }

    private function get ( $event_name )
    {
        if ( ! empty( $event_name ) ) {
            return $Class = new $event_name();
        } else {
            return $Class = new noEvent();
        }
    }
}