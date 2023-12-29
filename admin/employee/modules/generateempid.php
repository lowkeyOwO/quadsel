<?php
function generateID()
{
    $sql = "SELECT emp_id FROM `employee_details` WHERE emp_id like 'BBEM%' ORDER BY emp_id DESC LIMIT 1;";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $row = mysqli_fetch_array($result);
    $num = ((int) substr($row["emp_id"], 4)) + 1;
    return ($num < 10 ? "BBEM0" . ($num) : "BBEM" . $num);
}
?>