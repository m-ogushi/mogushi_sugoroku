<?php

class GameHtml implements HtmlInterface
{
    private $head;
    private $content;
    private $foot;

    //コンストラクタ
    public function __construct ()
    {
        $this->getHead();
        $this->getFoot();
    }

    private function getHead ()
    {
        ob_start();
        require( "head.html" );
        $this->head = ob_get_contents();
        ob_end_clean();
    }

    private function getFoot ()
    {
        ob_start();
        require( "foot.html" );
        $this->foot = ob_get_contents();
        ob_end_clean();
    }

    public function show ( Game $game )
    {
        $this->contents( $game->view->getContent() );

        echo $this->head;
        echo $this->content;
        echo $this->foot;

        return;
    }

    private function contents ( $contents )
    {
        ob_start();
        foreach ( $contents as $content ) {
            foreach ( $content as $key => $value ) {
                switch ( $key ) {
                    case "title":
                        echo "<h2>・" . $value . "</h2>\n";
                        break;
                    case "text":
                        echo "<a>" . $value . "</a>\n";
                        break;
                }
            }
        }
        $this->content = ob_get_contents();
        ob_end_clean();
    }
}
