<?php
require_once('db-connect.php');

if (isset($_POST['submit'])) {

    //$name = $_POST['name'];

    if (isset($_FILES['pdf_file']['name'])) {
        $file_name = $_FILES['pdf_file']['name'];
        $file_tmp = $_FILES['pdf_file']['tmp_name'];
        echo $file_tmp;

        move_uploaded_file($file_tmp, "./pdf/" . $file_name);
        echo $file_name;

    }

}
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
$allday = isset($allday);

if (empty($id)) {
    //$sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`,`filename`) VALUES ('$title','$description','$start_datetime','$end_datetime','$file_name')";
    $sql = "INSERT INTO `schedule_lists`(`court`,`start_datetime`,`filename`,`remarks`) VALUES ('$court','$start_datetime','$file_name','$remarks')";
    echo $sql;
} else {
    // $sql = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
}

$save = $conn->query($sql);

if ($save) {
    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./') </script>";
} else {
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: " . $conn->error . "<br>";
    echo "SQL: " . $sql . "<br>";
    echo "</pre>";
}

$conn->close();

?>