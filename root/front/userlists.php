<?php
require_once("../db/access.php");

class UserListsControl extends Control
{
    public $userId;

    public function __construct($userId, $headElements = array())
    {
        $this->$userId = $userId;
        parent::__construct($headElements);
    }

    public function WriteOpenTag()
    {
        $tdls = $GetTDLs($this->userId);
?>
<div>
<?php 
        //TODO ...
?>
</div>
<?php
    }
}
?>
