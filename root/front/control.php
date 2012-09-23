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

class BasicHTMLElement extends Control
{
    public $tagName;
    public $openText;
    public $closeText;
    public $CSSId;
    public $CSSClass;

    public function __construct($tagName, $CSSId = "", $CSSClass = "",
        $openText = "", $closeText = "", $headElements = array())
    {
        $this->tagName = $tagName;
        $this->openText = $openText;
        $this->closeText = $closeText;
        $this->CSSId = $CSSId;
        $this->CSSClass = $CSSClass;
        parent::__construct($headElements);
    }

    public function WriteOpenTag()
    {
        $idString = "";
        if ($this->CSSId)
        {
            $idString = "id=\"$this->CSSId\"";
        }
        $classString = "";
        if ($this->CSSClass)
        {
            $classString = "class=\"$this->CSSClass\"";
        }
        echo "<$this->tagName $idString $classString >\n$this->openText";
    }

    public function WriteCloseTag()
    {
        echo "$this->closeText\n</$this->tagName>\n";
    }
}
?>
