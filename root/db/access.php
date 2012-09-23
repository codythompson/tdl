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

function GetTDL($TDLId)
{
    global $db_mysqli;

    $TDLId = intval($TDLId);
    $query =
        "SELECT * FROM TodoList " .
        "WHERE TodoList_Id=$TDLId";
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

//TODO should split this into two functions.
function AddTDLItem($TDLId, $TDLItemName, $TDLItemDateCreation,
    $TDLItemDateEffective, $TDLItemDateDue)
{
    global $db_mysqli;

    $TDLId = intval($TDLId);
    $TDLItemName = CleanWithHtmlPurifier($TDLItemName);
    $TDLItemName = $db_mysqli->real_escape_string($TDLItemName);
    if (isDateTime($TDLItemDateCreation) && isDateTime($TDLItemDateEffective)
            && isDateTime($TDLItemDateDue)) {
        $query =
            "INSERT INTO TodoList_Item (TodoList_Id, TodoList_Item_Name) " .
            "VALUES ($TDLId, '$TDLItemName')";
        $queryResult = $db_mysqli->query($query);
        if ($queryResult == false) {
            return false;
        }
        $insertId = $db_mysqli->insert_id;

        $creationDateString = $TDLItemDateCreation->format("Y-m-d H:i:s");
        $effectiveDateString = $TDLItemDateEffective->format("Y-m-d H:i:s");
        $dueDateString = $TDLItemDateDue->format("Y-m-d H:i:s");
        $query =
            "INSERT INTO TodoList_Item_Date " .
            "(TodoList_Item_Id, TodoList_Item_Date_Creation, " . 
            "TodoList_Item_Date_Effective, TodoList_Item_Date_Due) " .
            "VALUES ($insertId, '$creationDateString', '$effectiveDateString'" .
            ", '$dueDateString')";
        $queryResult = $db_mysqli->query($query);
        if ($queryResult == false) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

function AddTDL($TDLUserId, $TDLName)
{
    global $db_mysqli;

    $TDLUserId = intval($TDLUserId);
    $TDLName = CleanWithHtmlPurifier($TDLName);
    $TDLName = $db_mysqli->real_escape_string($TDLName);

    $query =
        "INSERT INTO TodoList (TodoList_User_Id, TodoList_Name) " .
        "VALUES ($TDLUserId, '$TDLName')";
    $queryResult = $db_mysqli->query($query);

    echo $query;
    
    return $queryResult == true;
}
?>
