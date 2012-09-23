<?php
require_once("../db/access.php");
require_once("control.php");

class TodoListItemControl extends Control
{
    public $dataRow;
    public $formatInfo;

    private $baseCSSId;
    private $baseCSSClass;

    private $containerDiv;

    public function __construct($dataRow, $formatInfo, $baseCSSId = "",
        $baseCSSClass = "")
    {
        $this->dataRow = $dataRow;
        $this->formatInfo = $formatInfo;
        
        $this->baseCSSId = $baseCSSId;
        $this->baseCSSClass = $baseCSSClass;

        $this->containerDiv = new BasicHTMLElement("div", $baseCSSId,
            $baseCSSClass);
    }

    public function WriteOpenTag()
    {
        $this->containerDiv->WriteOpenTag();
    }

    public function WriteContent()
    {
        foreach($this->formatInfo as $key => $value)
        {
            if ($value)
            {
                $data = $this->dataRow[$key];
                if (empty($data))
                {
                    $data = "(none specified)";
                }
                $cssClass = $this->baseCSSClass . "_" . $key;
                $colDiv = new BasicHTMLElement("div", "", $cssClass, $data);
                $colDiv->WriteElement();
            }
        }
    }

    public function WriteCloseTag()
    {
        $this->containerDiv->WriteCloseTag();
    }
}

class TodoListControl extends Control
{
    public static $DEF_FORMAT_INFO = array(
        "TodoList_Item_Name" => "To Do",
        "TodoList_Item_Date_Effective" => "Start Date",
        "TodoList_Item_Date_Due" => "Due Date");

    public $listId;

    private $baseCSSId;
    private $baseCSSClass;

    public $formatInfo;

    private $containerDiv;

    public function __construct($listId, $baseCSSId = "todoList",
        $baseCSSClass = "todoList", $formatInfo = array())
    {
        $this->listId = $listId;

        $this->baseCSSId = $baseCSSId;
        $this->baseCSSClass = $baseCSSClass;

        if (empty($formatInfo))
        {
            $formatInfo = self::$DEF_FORMAT_INFO;
        }
        $this->formatInfo = $formatInfo;

        $this->containerDiv = new BasicHTMLElement("div", $baseCSSId,
            $baseCSSClass);
    }

    public function WriteOpenTag()
    {
        $this->containerDiv->WriteOpenTag();
    }

    public function WriteContent()
    {
        $headerCSSId = $this->baseCSSId . "_header";
        $headerCSSClass = $this->baseCSSClass . "_header";
        $header = new TodoListItemControl($this->formatInfo, $this->formatInfo, 
            $headerCSSId, $headerCSSClass);
        $header->WriteElement();

        $tdlItems = GetTDLItems($this->listId);
        $i = 0;
        foreach($tdlItems as $dataRow)
        {
            $cssId = $this->baseCSSId . "_item_$i";
            $i++;
            $cssClass = $this->baseCSSClass . "_item";
            $item = new TodoListItemControl($dataRow, $this->formatInfo, $cssId,
                $cssClass);
            $item->WriteElement();
        }
    }

    public function WriteCloseTag()
    {
        $this->containerDiv->WriteCloseTag();
    }
}
?>
