<?php
//require "html.php";

class View
{
    public function __construct()
    {
        $this->contents  = [];
        $this->html      = new Html();
    }

    public function append( $type, $context )
    {
        $this->contents[] = array( $type => $context );
    }

    public function html()
    {
        return $this->html;
    }
}
