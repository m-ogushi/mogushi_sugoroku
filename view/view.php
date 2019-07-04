<?php
require "html.php";

class View
{
    public function __construct()
    {
        $this->contents  = [];
        $this->html      = new Html();
    }

    /*private static $view;
    public static function getInstance()
    {
        if( !isset( $view ) )
        {
            $view = new View();
        }
        return $view;
    }*/

    public function append( $type, $context )
    {
        $this->contents[] = array( $type => $context );
    }

    public function html()
    {
        //$this->html = new Html( $this->contents );
        return $this->html->show($this->contents);
    }
}
