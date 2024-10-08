<?php
function pending_approvals()
{
    include '.../../../../../db_connection.php';
    $conn = OpenCon();
    echo "<div class='container mt-6 mb-6'>";
    $query = "SELECT * FROM `pending_employee_details`";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($emp_name, $date_of_birth, $address, $email_id, $aadhar_no, $pan_no, $password, $profile_photo_link, $phone_no);
    $numRows = $stmt->num_rows;
    if ($numRows == 0) {
        echo "<div class='container has-text-centered pt-6'>
        <h1 class='title is-1'>No Pending Approvals!</h1>
        </div>";
    } else {
        while ($stmt->fetch()) {
            $uniqueModalID = 'ModalID_' . $email_id;
            $uniqueRejectModalID = 'RejectModalID_' . $email_id;
            echo "
        <div class='box pt-6'>
        <div class='columns'>
            <div class='column is-2'>
                <figure class='image is-128x128'>
                    <img src='$profile_photo_link' class='custom-rad'>
                </figure>
            </div>
            <div class='column is-4'>
                <p class='title is-4'>Name:</p>
                <p class='subtitle is-6 mb-6'>$emp_name</p>
                <p class='title is-4'>Phone:</p>
                <p class='subtitle is-6'>$phone_no</p>
            </div>
            <div class='column is-4'>
                <p class='title is-4'>Aadhar No:</p>
                <p class='subtitle is-6 mb-6'>$aadhar_no</p>
                <p class='title is-4'>PAN No:</p>
                <p class='subtitle is-6'>$pan_no</p>
            </div>
            <div class='column is-2 mt-6'>
                <button class='button is-info has-icons mr-3 js-modal-trigger' data-target='$uniqueModalID'
                    type='button' name='view_profile_btn'>
                    <span class='icon'>
                        <i class='fa-solid fa-angles-right'></i>
                    </span>
                </button>
                <button class='button is-primary has-icons mr-3' type='submit' name='approve_btn' value='$email_id'>
                    <span class='icon'>
                        <i class='fa-solid fa-check'></i>
                    </span>
                </button>
                <button class='button is-danger has-icons mr-3 js-modal-trigger' data-target='$uniqueRejectModalID'
                type='button' name='enter_reason_btn'>
                    <span class='icon'>
                        <i class='fa-solid fa-xmark'></i>
                    </span>
                </button>
            </div>
        </div>
        <div id='$uniqueModalID' class='modal'>
            <div class='modal-background'></div>
            <div class='modal-content'>
                <div class='box'>
                    <div class='columns'>
                        <div class='column is-two-fifths'>
                            <p class='title is-4'>Name:</p>
                            <p class='subtitle is-6 mb-6'>$emp_name</p>
                            <p class='title is-4'>Address:</p>
                            <p class='subtitle is-6 mb-6'>$address</p>
                            <p class='title is-4'>Aadhar No:</p>
                            <p class='subtitle is-6 mb-6'>$aadhar_no</p>
                            <p class='title is-4'>Phone:</p>
                            <p class='subtitle is-6'>$phone_no</p>
                        </div>
                        <div class='column is-two-fifths'>
                            <p class='title is-4'>Date of birth:</p>
                            <p class='subtitle is-6 mb-6'>$date_of_birth</p>
                            <p class='title is-4'>Email:</p>
                            <p class='subtitle is-6 mb-6'>$email_id</p>
                            <p class='title is-4'>PAN No:</p>
                            <p class='subtitle is-6 mb-6'>$pan_no</p>
                        </div>
                        <div class='column is-one-fifths'>
                            <figure class='image is-4by5'>
                                <img src='$profile_photo_link' class='custom-rad'>
                            </figure>
                            <p class='title is-3 mt-6'>$email_id</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class='modal-close is-large' aria-label='close' type='button'></button>
        </div>
        <div id='$uniqueRejectModalID' class='modal'>
            <div class='modal-background'></div>
            <div class='modal-content'>
                <div class='box is-flex'>
                <input type='text' class='input is-primary' name='reject_reason' placeholder='Reason'>
                   <button name='reject_btn' class='button is-danger ml-3' type='submit' value='$email_id'>Reject</button>
                </div>
            </div>
            <button class='modal-close is-large' aria-label='close' type='button'></button>
        </div>
        </div>";
        }
        echo "</div>";
    }

    $stmt->close();
    
    CloseCon($conn);
}


?>