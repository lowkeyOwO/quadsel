<?php
function approve_employee()
{


    include '.../../../../../db_connection.php';
    $conn = OpenCon();
    $clickedEmpID = $_POST['approve_btn'];
    $query = "SELECT * FROM `pending_employee_details` WHERE email_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $clickedEmailID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($type, $emp_name, $date_of_birth, $address, $email_id, $aadhar_no, $pan_no, $password, $profile_photo_link, $phone_no);
    include_once ("./generateempid.php");
    $emp_id = generateID($type); 
    while ($stmt->fetch()) {
        $insertQuery = "INSERT INTO `employee_details` (emp_id, emp_name, date_of_birth, address, email_id, aadhar_no, pan_no, password, profile_photo_link, phone_number, date_of_joining) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $date_of_joining = date("Y-m-d H:i:s");
        $stmtInsert = $conn->prepare($insertQuery);
        $stmtInsert->bind_param("sssssisssis", $emp_id, $emp_name, $date_of_birth, $address, $email_id, $aadhar_no, $pan_no, $password, $profile_photo_link, $phone_no, $date_of_joining);
        $stmtInsert->execute();

        $deleteQuery = "DELETE FROM `pending_employee_details` WHERE emp_id=?";
        $stmtDelete = $conn->prepare($deleteQuery);
        $stmtDelete->bind_param("s", $emp_id);
        $stmtDelete->execute();

        $stmtInsert->close();
        $stmtDelete->close();
    }

    $stmt->close();

    CloseCon($conn);
}
?>