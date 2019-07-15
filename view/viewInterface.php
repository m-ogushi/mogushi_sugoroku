<?php
interface ViewInterface
{
    public function append( $type, $context );
    public function html();
    public function getContent();
}