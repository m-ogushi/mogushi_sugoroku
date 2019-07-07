<?php
class Html
{
    //コンストラクタ
    public function __construct()
    {
        $this->getHead();
        $this->getFoot();
    }

    public function getHead()
    {
        ob_start();
        require( "head.html" );
        $this->head = ob_get_contents();
        ob_end_clean();
    }

    public function getFoot()
    {
        ob_start();
        require( "foot.html" );
        $this->foot = ob_get_contents();
        ob_end_clean();
    }

    public function show($game)
    {
        $this->contents($game->view->contents);

        echo $this->head;
        echo $this->content;
        echo $this->foot;
        return;
    }

    public function contents($contents)
    {
        ob_start();
        foreach ( $contents as $content ){
            foreach ( $content as $key => $value ){
                switch ( $key ){
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
