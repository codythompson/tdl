<?php
require_once("../db/access.php");
require_once("control.php");

class UserListsControl extends Control
{
    public $userId;

    public $linkPath;
    
    private $baseCSSId;
    private $baseCSSClass;

    private $containerDiv;

    public function __construct($userId, $linkPath, $baseCSSId = "todoLists",
        $baseCSSClass = "todoLists")
    {
        $this->userId = $userId;
        $this->linkPath = $linkPath;
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
        $listDiv = new BasicHTMLElement("div");
        $listLink = new LinkElement($this->linkPath);

        $tdls = GetTDLs($this->userId);

        foreach($tdls as $tdl)
        {
            $listDiv->CSSId = $this->baseCSSId . "_" . $tdl["TodoList_Id"];
            $listDiv->CSSClass = $this->baseCSSClass . "_tdlContainer";

            $listLink->queryString = "?todolist_id=" . $tdl["TodoList_Id"];
            $listLink->text = $tdl["TodoList_Name"];

            $listDiv->WriteOpenTag();
            $listLink->WriteElement();
            $listDiv->WriteCloseTag();
        }
    }

    public function WriteCloseTag()
    {
        $this->containerDiv->WriteCloseTag();
    }
}
?>
