<?php
interface HtmlInterface
{
    public function getHead();
    public function getFoot();
    public function show(Game $game);
    public function contents($contents);
}