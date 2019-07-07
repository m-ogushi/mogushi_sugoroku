<?php
interface EventInterface
{
    public function player($game);
    public function turn_end($game);
}