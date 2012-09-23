<?php
require_once("../db/access.php");
require_once("../front/control.php");
require_once("../front/userlists.php");
require_once("../front/list.php");

?>
<html>
<head>
    <style>
.todoList_header
{
    clear:both;
}

.todoList_header div {
    float:left;
    width:152px;
    border:4px solid #258;
}

.todoList_item
{
    clear:both;
}

.todoList_item div {
    float:left;
    width:156px;
    border:2px solid #285;
}

#todoLists {
    clear:both;
}
    </style>
</head>
<body>
<?php

if (!empty($_GET["todolist_id"]))
{
    $listId = $_GET["todolist_id"];
    $tdl = new TodoListControl($listId);
    $tdl->WriteElement();
}

$lists = new UserListsControl(1, "test.php");

$lists->WriteElement();

?>
</body>
</html>
