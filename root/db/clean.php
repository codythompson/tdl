<?php
require_once("library/HTMLPurifier.auto.php");

function CleanWithHtmlPurifier($dirtyHtml)
{
    //copied and pasted from http://htmlpurifier.org/docs
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($dirtyHtml);

    return $clean_html;
}

function isDateTime($dateTimeObj)
{
    return (get_class($dateTimeObj) == "DateTime");
}

?>
