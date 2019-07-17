<?php

interface EventInterface
{
    public function player ( Game $game );

    public function turn_end ( Game $game );
}