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
    </form>..

    <?php
    include '.../../../../db_connection.php';
    $conn = OpenCon();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['pending_btn'])) {
            echo "irukuravanaye nee olunga vela vanga maatra";
        } else {
            if (isset($_POST['search_email'])) {
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
                                            type='submit' name='attendance_btn'>
                                            <span class='icon'>
                                                <i class='fa-regular fa-edit'></i>
                                            </span>
                                        </button></div>
                                    <div class='column is-one-fourth'><button class='button is-danger has-icons mt-6' type='submit'
                                            name='profile_btn'>
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

    }
    ?>
    <script>
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

        });</script>
</body>

</html>