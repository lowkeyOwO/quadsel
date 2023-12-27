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

$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

if ($request_method === 'POST') {
    $log_email = filter_input(INPUT_POST, 'log_email', FILTER_VALIDATE_EMAIL);
    $log_password = filter_input(INPUT_POST, 'log_password', FILTER_SANITIZE_STRING);

    if ($log_email === false || $log_password === null) {
        echo "Invalid input!";
    } else {
        $query = "SELECT * FROM `login` WHERE email=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $log_email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($result_email, $result_password);

        while ($stmt->fetch()) {
            if (password_verify($log_password, $result_password)) {
                $_SESSION["email"] = $result_email;
                header("Location: ./home");
            }
        }
        $stmt->close();
    }
}
CloseCon($conn);

?>