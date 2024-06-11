<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    print_r($file);

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'uploads/' . $fileNameNew;

                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    header("Location: uploadpic.php?uploadsuccess");
                    exit(); // Ensure no further code is executed after the redirect
                } else {
                    echo "Error moving the uploaded file.";
                }
            } else {
                echo "Your file is too big.";
            }
        } else {
            echo "There was an error uploading your file.";
        }
    } else {
        echo "This is the wrong file type.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data"> <!-- Use the current script -->
        <input type="file" name="file">
        <button type="submit" name="submit">UPLOAD</button> <!-- Fixed name attribute -->
    </form>
</body>
</html>
