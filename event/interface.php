<?php

interface EventInterface
{
    public function player ( Game $game );

    public function turnEnd ( Game $game );
}