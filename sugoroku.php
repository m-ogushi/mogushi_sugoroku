<?php
require "game.php";
require "board.php";
require "player.php";
require "dice.php";

$game = Game::getInstance();
$game->setBoard(new Board('data/board.csv'));
$game->addPlayer(new Player('Taro'));
$game->addPlayer(new Player('Jiro'));
$game->setDice(new Dice());
$game->start();
?>