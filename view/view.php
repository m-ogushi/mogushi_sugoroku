<?php

class View implements ViewInterface
{
    private $contents;
    private $html;

    public function __construct ( HtmlInterface $html )
    {
        $this->contents = [];
        $this->html = $html;
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
