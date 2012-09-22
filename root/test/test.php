<?php
require_once("../db/access.php");

function echoDiv($borderSize, $borderColor, $content)
{
?>
<div style="border:<?php echo $borderSize ?> solid <?php $borderColor ?>">
<?php
echo $content;
?>
</div>
<?php
}
$dt1 = new DateTime();
$dt2 = new DateTime();
$dt3 = new DateTime();

$itworked = AddTDLItem(1, "bwa ha ha.... 'ha 'ha \"", $dt1, $dt1, $dt1);

if ($itworked == true) {
    echoDiv(4, "#208050", "is true");
} else {
    echoDiv(4, "#502020", "is false");
}
?>
