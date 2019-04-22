<?php
require "game.php";
require "board.php";
require "player.php";
require "dice.php";
require "event/goadvance01.php";
require "event/goadvance02.php";
require "event/goadvance03.php";
require "event/goback01.php";
require "event/goback02.php";
require "event/goback03.php";
require "event/gostart.php";
require "event/rest.php";
require "event/replace.php";

$game = Game::getInstance();
$game->setBoard(new Board('data/board.csv'));
$game->addPlayer(new Player('Taro'));
$game->addPlayer(new Player('Jiro'));
$game->setDice(new Dice());
$game->start();
?>
