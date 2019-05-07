<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>
<body>

<?php
foreach ( $contents as $content ) {
    foreach ( $content as $key => $value ) {
        switch ( $key ) {
            case "title":
                echo "<h2>・" . $value . "</h2>\n";
                break;
            case "text":
                echo "<a>" . $value . "</a>\n";
                break;
        }

    }
}

?>
</body>
</html>