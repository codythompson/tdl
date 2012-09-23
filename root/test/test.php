<?php
require_once("../db/access.php");
require_once("../front/control.php");

$dc = new BasicHTMLElement("div", "a", "class_name", "open text", "close text");

//HTML SECTION
$dc->WriteOpenTag();
echo "<div>some garbage in between</div>";
$dc->WriteCloseTag();
?>
