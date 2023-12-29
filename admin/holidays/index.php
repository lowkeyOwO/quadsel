<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["holiday_data"])) {
            $file_name = "holiday.xlsx";
            $file_tmp = $_FILES["holiday_data"]["tmp_name"];
            $file_size = $_FILES["holiday_data"]["size"];
            $file_type = $_FILES["holiday_data"]["type"];
            $upload_dir = "./uploads/";
            $upload_path = $upload_dir . $file_name;
            if (move_uploaded_file($file_tmp, $upload_path)) {
                echo "File successfully uploaded. File name: " . $file_name;
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "File input not found.";
        }
    }
    ?>

</body>

</html>