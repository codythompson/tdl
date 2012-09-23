<?php
require_once("../db/access.php");

class UserListsControl extends Control
{
    public $userId;
    
    public $baseCSSId;

    public function __construct($userId, $baseCSSId = "todoLists", $headElements = array())
    {
        $this->userId = $userId;
        $this->baseCSSId = $baseCSSId;
        parent::__construct($headElements);
    }

    public function WriteOpenTag()
    {
        $tdls = $GetTDLs($this->userId);
?>
<div>
<?php 
        foreach($tdls as $tdl)
        {

        }
?>
</div>
<?php
    }
}
?>
