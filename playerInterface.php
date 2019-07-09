<?php
interface PlayerInterface
{
    public function beforeRollDice($game);
    public function checkRest($game);
    public function checkInCheckPoint($game);
    public function tryPassCheckPoint($game);
    public function rollDice($game);
    public function stayIfCheckIn($game);
    public function playerEvent($game);
    public function Goal($game);
}
