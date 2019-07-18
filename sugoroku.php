<?php
require "game.php";

require "board/interface.php";
require "board/board.php";

require "player/interface.php";
require "player/player.php";

require "dice/interface.php";
require "dice/dice.php";

require "getOccurEvent.php";

require "event/interface.php";
require "event/goAdvance01.php";
require "event/goAdvance02.php";
require "event/goAdvance03.php";
require "event/goBack01.php";
require "event/goBack02.php";
require "event/goBack03.php";
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

require "view/interface.php";
require "view/view.php";

require "html/interface.php";
require "html/gameHtml.php";

$game = Game::getInstance();
$game->setBoard( new Board( 'board/board.csv' ) );
$game->addPlayer( new Player( 'Taro', $game ) );
$game->addPlayer( new Player( 'Jiro', $game ) );
$game->addDice( new Dice( 8 ) );
$game->addDice( new Dice( 6 ) );

$game->setView( new View( new GameHtml() ) );
$game->start();
