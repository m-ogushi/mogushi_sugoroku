<?php
interface PlayerInterface
{
    public function beforeRollDice(Game $game);
    public function checkRest(Game $game);
    public function checkInCheckPoint(Game $game);
    public function tryPassCheckPoint(Game $game);

    public function rollDice(Game $game);

    public function stayIfCheckIn(Game $game);

    public function checkGoalOrNot(Game $game);

    public function move($forward_spaces);
    public function addRestFlag();
    public function backStart();

    public function getPlace();
    public function setPlace($place);
    public function getName();
    public function getThisTurnMoveOrNot();
}
