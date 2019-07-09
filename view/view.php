<?php
class View implements ViewInterface
{
    public function __construct(HtmlInterface $html)
    {
        $this->contents  = [];
        $this->html      = $html;
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
