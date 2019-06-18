<?php
require "game.php";
require "board.php";
require "player.php";
require "dice.php";
require "diceprogress.php";
require "eventoccur.php";
require "eventmethod.php";
require "stopchecksquare.php";
require "playergoal.php";
require "event/goadvance01.php";
require "event/goadvance02.php";
require "event/goadvance03.php";
require "event/goback01.php";
require "event/goback02.php";
require "event/goback03.php";
require "event/gostart.php";
require "event/rest.php";
require "event/replace.php";
require "event/assistlast01.php";
require "event/assistlast02.php";
require "event/assistlast03.php";
require "event/bothertop01.php";
require "event/bothertop02.php";
require "event/bothertop03.php";
require "event/check.php";
require "event/goal.php";
require "event/eventfunction.php";
require "view/view.php";

$game = Game::getInstance();
$game->setBoard(new Board('data/board.csv'));
$game->addPlayer(new Player('Taro',$game->board ));
$game->addPlayer(new Player('Jiro',$game->board ));
$game->setDice(new Dice( 8 ));
$game->setDice(new Dice( 6 ));
$game->view = View::getInstance();
$game->start();
?>
