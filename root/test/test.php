<?php
require_once("../db/access.php");

function echoDiv($borderSize, $borderColor, $content)
{
?>
<div style="border:<?php echo $borderSize ?> solid <?php $borderColor ?>;">
<?php
echo $content;
?>
</div>
<?php
}
$tdl = AddTDL(1, "Test Todo List <div onload='alert()'></div>");

if ($tdl == false) {
    echoDiv("2px", "#802020", "is false");
} else {
    echoDiv("2px", "#802020", "is true");
}
?>
