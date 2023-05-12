<?php

$Get_Court = $_GET['Court'];

//echo $Get_Court;

include_once 'db-connect.php';

$result = mysqli_query($conn, "SELECT * FROM schedule_lists WHERE court LIKE '%" . $Get_Court . "%'");

$object_array = [];

$i = 0;

while ($row = $result->fetch_assoc()) {
    //echo $row['id'].','.$row['court'].','.$row['start_datetime'].','.$row['filename'].','.$row['remarks'];

    $object = array(
        'id' => $row['id'],
        'court' => $row['court'],
        'datetime' => $row['start_datetime'],
        'filename' => $row['filename'],
        'remarks' => $row['remarks']
    );

    $object_array[$i] = $object;
    $i++;

}

//echo mysqli_num_rows($result);

echo json_encode($object_array);
// return $object_array;
?>