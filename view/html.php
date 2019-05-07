<?php
class Html
{
    //コンストラクタ
    public function __construct( $contents )
    {
        $this->contents = $contents;
        $html = include( "html_content.php" );
    }

    public function show(){

    }
}
