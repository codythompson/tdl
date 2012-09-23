<?php
require_once("../db/access.php");
require_once("control.php");

class UserListsControl extends Control
{
    public $userId;
    
    public $baseCSSId;
    public $baseCSSClass;

    private $containerDiv;

    public function __construct($userId, $baseCSSId = "todoLists",
        $baseCSSClass = "todoLists", $headElements = array())
    {
        $this->userId = $userId;
        $this->baseCSSId = $baseCSSId;
        $this->baseCSSClass = $baseCSSClass;
        parent::__construct($headElements);
    }

    public function WriteOpenTag()
    {
        $containerDiv = new BasicHTMLElement("div", $this->baseCSSId,
            $this->baseCSSClass);
        $containerDiv->WriteOpenTag();

        $listDiv = new BasicHTMLElement("div");

        $tdls = GetTDLs($this->userId);
        foreach($tdls as $tdl)
        {
            $listDiv->CSSId = $this->baseCSSId . "_" . $tdl["TodoList_Id"];
            $listDiv->CSSClass = $this->baseCSSClass . "_tdlContainer";
            $listDiv->openText = $tdl["TodoList_Name"];

            $listDiv->WriteOpenTag();
            $listDiv->WriteCloseTag();
        }

        $this->containerDiv = $containerDiv;
    }

    public function WriteCloseTag()
    {
        $this->containerDiv->WriteCloseTag();
    }
}
?>
