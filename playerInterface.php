<?php
interface PlayerInterface
{
    public function beforeRollDice($game);
    public function checkRest($game);
    public function checkInCheckPoint($game);
    public function tryPassCheckPoint($game);

    public function rollDice($game);

    public function stayIfCheckIn($game);

    public function checkGoalOrNot($game);

    public function move($forward_spaces);
    public function addRestFlag();
    public function backStart();

    public function getPlace();
    public function setPlace($place);
    public function getName();
    public function getThisTurnMoveOrNot();
}
