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
                        <input class="input is-primary" type="email" name="search_email" placeholder="Email of employee"
                            value="<?php echo isset($_POST['search_email']) ? htmlspecialchars($_POST['search_email']) : ''; ?>"></input>
                        <span class="icon is-left">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
                <div class="column is-one-fifths">
                    <button class="button is-primary has-icons mr-5" type="submit" name="attendance_btn" id="attendance_btn">
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['pending_btn'])) {
                include('./modules/pending.php');
                pending_approvals();
            } else if (isset($_POST['approve_btn'])) {
                include('./modules/approve.php');
                approve_employee();
            } else if (isset($_POST['reject_btn'])) {
                include('./modules/reject.php');
                reject_employee();
            } else if (isset($_POST["edit_profile_btn"])) {
               include("./modules/editprofile.php");
                edit_profile();
            } else if (isset($_POST["delete_profile_btn"])) {
                include("./modules/editprofile.php");
                $del_emp_id = $_POST['delete_profile_btn'];
                delete_profile($del_emp_id);
            } else if (isset($_POST['search_email'])) {
                $search_email = $_POST['search_email'];
                if (trim($search_email) == "") {
                    echo "<div class='container has-text-centered pt-6'>
                    <h1 class='title is-1 has-text-danger'>Email cannot be empty!</h1>
                    </div>";
                } else {
                    if (isset($_POST['attendance_btn'])) {
                        include('./modules/attendance.php');
                        view_employee_attendance($search_email);
                    } else if (isset($_POST['profile_btn'])) {
                        include('./modules/profile.php');
                        view_employee_profile($search_email);
                    }
                }
            }
        }
        ?>
    </form>
    <script src="index.js" />
</body>

</html>