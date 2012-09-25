<?php
class TableRow
{
    public $dataRow;

    public function __construct($dataRow)
    {
        $this->$dataRow = $dataRow;
    }
}
?>
