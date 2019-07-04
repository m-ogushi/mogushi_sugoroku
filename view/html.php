<?php
class Html
{
    //コンストラクタ
    public function __construct( /*$contents*/ )
    {
        /*ob_start();
        require( "html_content.php" );
        $this->html = ob_get_contents();
        ob_end_clean();
        return $this->html;*/
    }

    public function show($contents)
    {
        ob_start();
        require( "html_content.php" );
        $this->html = ob_get_contents();
        ob_end_clean();
        return $this->html;
    }
}
