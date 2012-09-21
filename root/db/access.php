<?php
require_once("../../../dbcon.php");
require_once("clean.php");

function GetTDLItemDate($TDLItemId)
{
    global $db_mysqli;

    $TDLItemId = intval($TDLItemId);
    $query =
        "SELECT * FROM TodoList_Item_Date " .
        "WHERE TodoList_Item_Id=$TDLItemId";
    $queryResult = $db_mysqli->query($query);
    if ($queryResult->num_rows > 0)
    {
        return $queryResult->fetch_assoc();
    }
    else
    {
        return null;
    }
}

function GetTDLItems($TDLId)
{
    global $db_mysqli;

    $TDLId = intval($TDLId);
    $query =
        "SELECT TodoList_Item.TodoList_Item_Id, TodoList_Item.TodoList_Id, " .
        "TodoList_Item.TodoList_Item_Name, " .
        "TodoList_Item_Date.TodoList_Item_Date_Creation, " .
        "TodoList_Item_Date.TodoList_Item_Date_Effective, " .
        "TodoList_Item_Date.TodoList_Item_Date_Due ".
        "FROM TodoList_Item " .
        "LEFT JOIN TodoList_Item_Date " .
        "ON TodoList_Item.TodoList_Item_Id=" .
        "TodoList_Item_Date.TodoList_Item_Id " .
        "WHERE TodoList_Item.TodoList_Id=$TDLId " .
        "ORDER BY TodoList_Item_Date.TodoList_Item_Date_Effective";
    $queryResult = $db_mysqli->query($query);

    $itemsList = array();
    $i = 0;
    while($item = $queryResult->fetch_assoc())
    {
        $itemsList[$i] = $item;
        $i++;
    }
    return $itemsList;
}

function GetTDLs($TDLUserId)
{
    global $db_mysqli;

    $TDLUserId = intval($TDLUserId);
    $query =
        "SELECT * FROM TodoList " .
        "WHERE TodoList_User_Id=$TDLUserId";
    $queryResult = $db_mysqli->query($query);

    $listsList = array();
    $i = 0;
    while($list = $queryResult->fetch_assoc())
    {
        $listsList[$i] = $list;
        $i++;
    }
    return $listsList;
}

function AddTDLItem($TDLId, $TDLItemName, $TDLItemDateCreation,
    $TDLItemDateEffective, $TDLItemDateDue)
{
    global $db_mysqli;

    $TDLId = intval($TDLId);
    $TDLItemName = CleanWithHtmlPurifier($TDLItemName);
    $TDLItemName = $db_mysqli->real_escape_string($TDLItemName);
    if (isDateTime($TDLItemDateCreation) && isDateTime($TDLItemDateEffective)
            && isDateTime($TDLItemDueDate)) {
        $query =
            "INSERT INTO TodoList_Item (TodoList_Id, TodoList_Item_Name) " .
            "VALUES ($TDLId, '$TDLItemName')";
        $queryResult = $db_mysqli->query($query);
        $insertId = $db_mysqli->insert_id;
        $query =
            "INSERT INTO TodoList_Item_Date " .
            "(TodoList_Item_Id, TodoList_Item_Date_Creation, " . 
            "TodoList_Item_Date_Effective, TodoList_Item_Date_Due) " . "";
//TODO finish this query
        return true;
    } else {
        return false;
    }
}

?>
