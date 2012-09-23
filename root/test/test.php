<?php
require_once("../db/access.php");
require_once("../front/control.php");

$dc = new DivControl("open text", "close text", "someId");

//HTML SECTION
$dc->WriteOpenTag();
$dc->WriteCloseTag();
?>
