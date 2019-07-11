<?php
require "game.php";

require "boardInterface.php";
require "board.php";

require "playerInterface.php";
require "player.php";

require "diceInterface.php";
require "dice.php";

require "getOccurEvent.php";

require "eventInterface.php";
require "event/goAdvance01.php";
require "event/goAdvance02.php";
require "event/goAdvance03.php";
require "event/goBack01.php";
require "event/goBack02.php";
require "event/goback03.php";
require "event/goStart.php";
require "event/rest.php";
require "event/replace.php";
require "event/assistLast01.php";
require "event/assistLast02.php";
require "event/assistLast03.php";
require "event/botherTop01.php";
require "event/botherTop02.php";
require "event/botherTop03.php";
require "event/check.php";
require "event/moreProgress.php";
require "event/goal.php";
require "event/eventUtility.php";
require "event/noEvent.php";

require "view/viewInterface.php";
require "view/view.php";
require "view/htmlInterface.php";
require "view/gameHtml.php";

$game = Game::getInstance();
$game->setBoard(new Board('data/board.csv'));
$game->addPlayer(new Player('Taro',$game ));
$game->addPlayer(new Player('Jiro',$game ));
$game->addDice(new Dice( 8 ));
$game->addDice(new Dice( 6 ));

$html = new GameHtml();
$game->setView(new View($html));
$game->start();
