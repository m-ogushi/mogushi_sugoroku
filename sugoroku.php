<?php
require "game.php";
require "board.php";
require "player.php";
require "dice.php";
require "event/goadvance.php";
require "event/goback.php";

$game = Game::getInstance();
$game->setBoard(new Board('data/board.csv'));
$game->addPlayer(new Player('Taro'));
$game->addPlayer(new Player('Jiro'));
$game->setDice(new Dice());
//$game->addEvent(new Event());
$game->start();
?>
