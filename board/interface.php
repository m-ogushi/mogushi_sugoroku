<?php

interface BoardInterface
{
    public function getEventNameFromPlace ( $place );

    public function getMapLength ();

    public function getCheckPlaces ();
}