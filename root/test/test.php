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

$dateObj = AddTDLItem(1, "<div>bwa ha ha <script>alert('woo')</script></div>", "", "", "");
//$dateObj = AddTDLItem(1, "bwa ha ha", "", "", "");

if ($dateObj == true)
{
   echoDiv("2px", "#803020", "is true"); 
}
else
{
   echoDiv("2px", "#803020", "is false"); 
}
?>