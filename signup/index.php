<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="email" name="log_email" placeholder="email">
        <input type="password" name="log_password" placeholder="password">
        <input type="password" name="log_re_password" placeholder="Re-enter password">
        <button type='submit'>submit</button>
    </form>
</body>

</html>
<?php
include '../db_connection.php';
$conn = OpenCon();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['log_email']) && isset($_POST['log_password']) && isset($_POST['log_re_password'])) {
        $log_email = $_POST['log_email'];
        $log_password = $_POST['log_password'];
        $log_re_password = $_POST['log_password'];
        if (trim($log_email) == "" or trim($log_password) == "" or trim($log_re_password) == "") {
            "Cannot be empty!";
        } else {
            if ($log_password === $log_re_password) {
                $query = "INSERT INTO `login` VALUES (?,?);";
                $stmt = $conn->prepare($query);
                $hash_pw = password_hash(trim($log_password), PASSWORD_DEFAULT);
                $stmt->bind_param("ss", $log_email, $hash_pw);
                $stmt->execute();
                $stmt->close();
                header("Location: ../index.php");
            } else {
                echo "Please ensure the passwords are same!";
            }

        }

    } else {
        echo "Form fields not set.";
    }
}
?>