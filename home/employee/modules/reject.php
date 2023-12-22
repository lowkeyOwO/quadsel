<?php
function reject_employee()
{
    include '.../../../../../db_connection.php';
    $conn = OpenCon();
    $reason = $_POST['reject_reason'];
    echo "<h1>REASON: $reason</h1>";
    $clickedEmpID = $_POST['reject_btn'];
    $query = "SELECT email_id FROM `pending_employee_details` WHERE emp_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $clickedEmpID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email_id);
    while ($stmt->fetch()) {
        $insertQuery = "INSERT INTO `rejected_employee_details` (email_id,reason) 
                                    VALUES (?,?)";
        $stmtInsert = $conn->prepare($insertQuery);
        $stmtInsert->bind_param("ss", $email_id, $reason);
        $stmtInsert->execute();
        $deleteQuery = "DELETE FROM `pending_employee_details` WHERE emp_id=?";
        $stmtDelete = $conn->prepare($deleteQuery);
        $stmtDelete->bind_param("s", $clickedEmpID);
        $stmtDelete->execute();
        $stmtInsert->close();
        $stmtDelete->close();
    }
    $stmt->close();
}
CloseCon($conn);
?>