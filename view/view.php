<?php

class View implements ViewInterface
{
    private $contents;
    private $html;

    public function __construct ()
    {
        $this->contents = [];
        $this->html = new GameHtml();
    }

    public function append ( $type, $context )
    {
        $this->contents[] = [ $type => $context ];
    }

    public function html ()
    {
        return $this->html;
    }

    public function getContent ()
    {
        return $this->contents;
    }
}
