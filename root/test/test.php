<?php
require_once("../db/access.php");
require_once("../front/control.php");
require_once("../front/userlists.php");

$lists = new UserListsControl(1);

$lists->WriteOpenTag();
$lists->WriteCloseTag();

?>
