<?php
interface HtmlInterface
{
    public function getHead();
    public function getFoot();
    public function show($game);
    public function contents($contents);
}