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
    abstract public function WriteContent();
    abstract public function WriteCloseTag();

    public function WriteElement()
    {
        $this->WriteOpenTag();
        $this->WriteContent();
        $this->WriteCloseTag();
    }
}

class BasicHTMLElement extends Control
{
    public $text;
    public $closeText;
    public $CSSId;
    public $CSSClass;

    public function __construct($tagName, $CSSId = "", $CSSClass = "",
        $text = "", $headElements = array())
    {
        $this->tagName = $tagName;
        $this->CSSId = $CSSId;
        $this->CSSClass = $CSSClass;
        $this->text = $text;
        parent::__construct($headElements);
    }

    public function GetCSSIdString()
    {
        if ($this->CSSId)
        {
            return "id=\"$this->CSSId\"";
        } else {
            return "";
        }
    }

    public function GetCSSClassString()
    {
        if ($this->CSSClass)
        {
            return "class=\"$this->CSSClass\"";
        } else {
            return "";
        }
    }

    public function WriteOpenTag()
    {
        $idString = $this->GetCSSIdString();
        $classString = $this->GetCSSClassString(); 
        echo "<$this->tagName $idString $classString >";
    }

    public function WriteContent()
    {
        echo $this->text;
    }

    public function WriteCloseTag()
    {
        echo "\n</$this->tagName>";
    }
}

class LinkElement extends BasicHTMLElement
{
    public $href;
    public $queryString;

    public function __construct($href, $queryString = "", $CSSId = "",
        $CSSClass = "", $text = "", $headElements = array())
    {
        $this->href= $href;
        parent::__construct("a", $CSSId, $CSSClass, $text, $headElements);
    }

    public function GetHREFString()
    {
        $href = $this->href . $this->queryString;
        return "href=\"$href\"";
    }

    public function WriteOpenTag()
    {
        $hrefString = $this->GetHREFString();
        $idString = $this->GetCSSIdString();
        $classString = $this->GetCSSClassString();
        echo "<$this->tagName $hrefString $idString $classString >";
    }
}
?>
