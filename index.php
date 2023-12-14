<!DOCTYPE html>
<html lang="en" style='overflow-y:hidden'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="email" name="log_email" placeholder="email">
        <input type="password" name="log_password" placeholder="password">
        <button type='submit'>submit</button>
    </form>
    <a href="./forgot_password">forgot password</a>
    <a href="./signup">signup</a>
</body>


</html>
<?php
include 'db_connection.php';
$conn = OpenCon();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['log_email']) && isset($_POST['log_password'])) {
        $log_email = $_POST['log_email'];
        $log_password = $_POST['log_password'];
        if (trim($log_email) == "" or trim($log_password) == "") {
            "Cannot be empty!";
        } else {
            $query = "SELECT * FROM `login` WHERE email=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $log_email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($result_email, $result_password);
            while ($stmt->fetch()) {
                if (password_verifY($log_password, $result_password)) {
                    $_SESSION["email"] = $result_email;
                    header("Location: ./home");
                }
            }
            $stmt->close();
        }
    } else {
        echo "Form fields not set.";
    }
}
?>


<!-- <style>
    .bg {
        background-color: #000000;
        background-image: radial-gradient(#d1001f 2px, transparent 2px), radial-gradient(#d1001f 2px, #000000 2px);
        background-size: 80px 80px;
        background-position: 0 0, 40px 40px;
    }

    .compl {
        background-color: #d1001f;
    }
</style>


<body class="hero is-fullheight bg">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-three-fifths">
                    <form action='' method="post" class="box">
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" placeholder="e.g. alex@example.com">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input" type="password" placeholder="********">
                            </div>
                        </div>
                        <button class="button is-primary">Sign in</button>
                        <a href="./forgot_password" class="ml-6">Forgot Password?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body> -->