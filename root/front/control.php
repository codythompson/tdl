<?php
abstract class Control
{
    public $headElements = array();

    public function __construct($headElements)
    {
        $this->headElements = $headElements;
    }

    public function WriteHeadElements()
    {
        foreach($this->headElements as $headEle)
        {
            echo $headEle;
        }
    }

    abstract public function WriteOpenTag();
    abstract public function WriteCloseTag();
}

class DivControl extends Control
{
    public $openText;
    public $closeText;
    public $divId;
    public $divClassName;

    public function __construct($openText = "", $closeText = "", $divId = "",
        $divClassName = "", $headElements = array())
    {
        $this->openText = $openText;
        $this->closeText = $closeText;
        $this->divId = $divId;
        $this->divClassName = $divClassName;
        parent::__construct($headElements);
    }

    public function WriteOpenTag()
    {
?>
<div id="<?php echo $this->divId; ?>" class="<?php echo $this->divClassName; ?>">
<?php
        if ($this->openText) 
        {
            echo $this->openText;
        }
    }

    public function WriteCloseTag()
    {
        if ($this->closeText)
        {
            echo $this->closeText;
        }
?>
</div>
<?php
    }
}
?>
