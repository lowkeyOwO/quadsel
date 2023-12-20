<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/5718f6eb3a.js" crossorigin="anonymous"></script>
    <style>
        #navbar-item {
            background: url(../quadsel_logo.png) no-repeat center center;
            background-size: cover;
            width: 130px;
        }

        .custom-rad {
            border-radius: 6px;
        }
    </style>

</head>

<body>
    <nav class="navbar has-shadow " role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" id="navbar-item" href="./">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="mainNav">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="mainNav" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item" href="../">
                    Analytics
                </a>

                <a class="navbar-item" href="./">
                    Employee
                </a>
                <a class="navbar-item" href="../visitors">
                    Visitors
                </a>

                <a class="navbar-item button is-danger mt-2">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="container mt-6">
            <div class="columns">
                <div class="column is-one-fifths"><button class="button is-info has-icons" type="submit"
                        name="pending_btn">
                        <span class="icon">
                            <i class="fa-regular fa-clock"></i>
                        </span>
                        <h1>Pending Approvals</h1>
                    </button></div>
                <div class="column is-three-fifths">
                    <div class="control has-icons-left">
                        <input class="input is-primary" type="email" name="search_email"
                            placeholder="Email of employee"></input>
                        <span class="icon is-left">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
                <div class="column is-one-fifths">
                    <button class="button is-primary has-icons mr-5" type="submit" name="attendance_btn">
                        <span class="icon">
                            <i class="fa-regular fa-calendar-days"></i>
                        </span>
                    </button>
                    <button class="button is-primary has-icons mr-5" type="submit" name="profile_btn">
                        <span class="icon">
                            <i class="fa-regular fa-user"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <?php
        include '.../../../../db_connection.php';
        $conn = OpenCon();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['pending_btn'])) {
                echo "<div class='container mt-6 mb-6'>";
                $query = "SELECT * FROM `pending_employee_details`";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($emp_id, $emp_name, $date_of_birth, $address, $email_id, $aadhar_no, $pan_no, $password, $profile_photo_link, $phone_no);
                while ($stmt->fetch()) {
                    $uniqueModalID = 'ModalID_' . $emp_id;
                    $uniqueRejectModalID = 'RejectModalID_' . $emp_id;
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
                        <button class='button is-primary has-icons mr-3' type='submit' name='approve_btn' value='$emp_id'>
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
                                    <p class='title is-3 mt-6'>$emp_id</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class='modal-close is-large' aria-label='close' type='button'></button>
                </div>
                <div id='$uniqueRejectModalID' class='modal'>
                    <div class='modal-background'></div>
                    <div class='modal-content'>
                        <div class='box'>
                        <input type='text' name='reject_reason' placeholder='reason'>
                           <button name='reject_btn' value='$emp_id'></button>
                        </div>
                    </div>
                    <button class='modal-close is-large' aria-label='close' type='button'></button>
                </div>
                </div>";
                }
                echo "</div>";
                $stmt->close();
            } else if (isset($_POST['approve_btn'])) {
                $clickedEmpID = $_POST['approve_btn'];
                $query = "SELECT * FROM `pending_employee_details` WHERE emp_id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $clickedEmpID);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($emp_id, $emp_name, $date_of_birth, $address, $email_id, $aadhar_no, $pan_no, $password, $profile_photo_link, $phone_no);

                while ($stmt->fetch()) {
                    $insertQuery = "INSERT INTO `employee_details` (emp_id, emp_name, date_of_birth, address, email_id, aadhar_no, pan_no, password, profile_photo_link, phone_number, date_of_joining) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $date_of_joining = date("Y-m-d H:i:s");
                    $stmtInsert = $conn->prepare($insertQuery);
                    $stmtInsert->bind_param("sssssssssss", $emp_id, $emp_name, $date_of_birth, $address, $email_id, $aadhar_no, $pan_no, $password, $profile_photo_link, $phone_no, $date_of_joining);
                    $stmtInsert->execute();

                    $deleteQuery = "DELETE FROM `pending_employee_details` WHERE emp_id=?";
                    $stmtDelete = $conn->prepare($deleteQuery);
                    $stmtDelete->bind_param("s", $emp_id);
                    $stmtDelete->execute();

                    $stmtInsert->close();
                    $stmtDelete->close();
                }

                $stmt->close();
            } else if (isset($_POST['reject_btn'])) {
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
                    $stmtDelete->bind_param("s", $emp_id);
                    $stmtDelete->execute();
                    $stmtInsert->close();
                    $stmtDelete->close();
                }
                $stmt->close();
            } else if (isset($_POST['search_email'])) {
                $search_email = $_POST['search_email'];
                if (trim($search_email) == "") {
                    echo "Email Cannot be empty!";
                } else {
                    if (isset($_POST['attendance_btn'])) {
                        $query = "SELECT * FROM `employee_attendance` WHERE email_id=?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $search_email);
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($emp_id, $date, $check_in_time, $check_out_time, $email_id);
                        echo "
                        <div class='container mt-6'>
                            <table class='table is-bordered is-striped'>
                            <thead class='has-background-primary'>
                                <tr>
                                    <th>Date</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                </tr>
                             </thead>
                             <tbody>";
                        while ($stmt->fetch()) {
                            echo "      
                            <tr>                 
                             <td>$date</td>
                             <td>$check_in_time</td>
                             <td>$check_out_time</td>
                             </tr>
                            ";
                        }
                        echo "</tbody>
                        </table> </div>";
                        $stmt->close();
                    } else if (isset($_POST['profile_btn'])) {
                        $query = "SELECT * FROM `employee_details` WHERE email_id=?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $search_email);
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($emp_id, $emp_name, $date_of_birth, $address, $email_id, $aadhar_no, $pan_no, $password, $profile_photo_link, $phone_no, $date_of_joining);
                        while ($stmt->fetch()) {
                            echo "<div class='box m-5'>
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
                                <p class='title is-1 mt-6'>$emp_id</p>
                            </div>
                            <div class='column is-two-fifths'>
                                <p class='title is-4'>Date of birth:</p>
                                <p class='subtitle is-6 mb-6'>$date_of_birth</p>
                                <p class='title is-4'>Email:</p>
                                <p class='subtitle is-6 mb-6'>$email_id</p>
                                <p class='title is-4'>PAN No:</p>
                                <p class='subtitle is-6 mb-6'>$pan_no</p>
                                <p class='title is-4'>Date of Joining:</p>
                                <p class='subtitle is-6 mb-6'>$date_of_joining</p>
                            </div>
                            <div class='column is-one-fifths'>
                                <figure class='image is-4by5'>
                                    <img src='$profile_photo_link' class='custom-rad'>
                                </figure>
                                <div class='columns'>
                                    <div class='column is-half'></div>
                                    <div class='column is-one-fourth'><button class='button is-primary has-icons mt-6 mr-3'
                                            type='submit' name='edit_profile_btn'>
                                            <span class='icon'>
                                                <i class='fa-regular fa-edit'></i>
                                            </span>
                                        </button></div>
                                    <div class='column is-one-fourth'><button class='button is-danger has-icons mt-6' type='submit'
                                            name='delete_profile_btn'>
                                            <span class='icon'>
                                                <i class='fa-solid fa-trash'></i>
                                            </span>
                                        </button></div>
                                </div>
                            </div>
                        </div>
                    </div>";
                        }
                        $stmt->close();
                    }
                }
            }
        }
        ?>
    </form>
    <script>
        // Responsive Navbar
        document.addEventListener('DOMContentLoaded', () => {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
            });

        });

        // Modal Functionalities

        document.addEventListener('DOMContentLoaded', () => {
            function openModal(event) {
                event.preventDefault();
                const modalId = event.currentTarget.getAttribute('data-target');
                const modal = document.getElementById(modalId);
                openModal(modal);
            }
            function openModal($el) {
                $el.classList.add('is-active');
            }

            function closeModal($el) {
                $el.classList.remove('is-active');
            }

            function closeAllModals() {
                (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                    closeModal($modal);
                });
            }

            (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
                const modal = $trigger.dataset.target;
                const $target = document.getElementById(modal);
                console.log($target);
                $trigger.addEventListener('click', () => {
                    openModal($target);
                });
            });

            (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
                const $target = $close.closest('.modal');

                $close.addEventListener('click', () => {
                    closeModal($target);
                });
            });

            document.addEventListener('keydown', (event) => {
                if (event.code === 'Escape') {
                    closeAllModals();
                }
            });
        });
    </script>
</body>

</html>