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
$tdl = GetTDL(2);

if ($tdl == null) {
    echoDiv("2px", "#802020", "is null");
} else {
    print_r($tdl);
}
?>
