<?php
include_once 'db-connect.php';
$result = mysqli_query($conn, "SELECT * FROM schedule_lists");
?>
<!DOCTYPE html>
<html>
<title>Save Form</title>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to use Full Calendar with MySQL in PHP? - Nicesnippets.com</title>
    <link rel="stylesheet" href="dist/css/font-awesome.min" />
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" />
    <link rel="stylesheet" type="text/css" href="dist/css/datatables.min.css" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient text-light" id="topNavBar">
                    <div class="container d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Event Details Form</h1>
                            </div>
                        </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card rounded-0 shadow">
                            <div class="card-header bg-gradient bg-primary text-light">
                                <h5 class="card-title">Schedule Form</h5>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form action="save_schedule.php" method="post" id="schedule-form"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="">
                                        <!--  <div class="form-group mb-2">
                                            <label for="title" class="control-label">Title</label>
                                            <input type="text" class="form-control form-control-sm rounded-0"
                                                name="title" id="title" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="description" class="control-label">Description</label>
                                            <textarea rows="3" class="form-control form-control-sm rounded-0"
                                                name="description" id="description" required></textarea>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="start_datetime" class="control-label">Start</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-0"
                                                name="start_datetime" id="start_datetime" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="end_datetime" class="control-label">End</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-0"
                                                name="end_datetime" id="end_datetime" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <input type="file" name="pdf_file" class="form-control" accept=".pdf"
                                                title="Upload PDF" />
                                        </div> -->

                                        <div class="form-group mb-3">
                                            <label for="title" class="control-label">Court Types</label>
                                            <select name="court" class="form-control form-control-sm mb-3 rounded-0"
                                                name="court" id="court" required>
                                                <option value="District Court/Magistrate Court">District Court/Magistrate Court</option>
                                                <option value="Supreme Court">Supreme Court</option>
                                                <option value="Court Of Appeal">Court Of Appeal</option>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="start_datetime" class="control-label">Date</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-0"
                                                name="start_datetime" id="start_datetime" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="file" name="pdf_file" class="form-control" accept=".pdf"
                                                title="Upload PDF" required/>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="remarks" class="control-label">Remarks</label>
                                            <textarea rows="3" class="form-control form-control-sm rounded-0"
                                                name="remarks" id="remarks" required></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button class="btn btn-primary btn-sm rounded-0" type="submit" name="submit"
                                        form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                    <button class="btn btn-default border btn-sm rounded-0" type="reset"
                                        form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Records from Database</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="EventDataTbl">
                                <thead>
                                    <!-- <th>Title</th>
                                    <th>Description</th>
                                    <th>Start_datetime</th>
                                    <th>end_datetime</th>
                                    <th>FileName</th> -->
                                    <th>Court Types</th>
                                    <th>Date</th>
                                    <th>Filename</th>
                                    <th>Remarks</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * from schedule_lists";
                                    $save = $conn->query($sql);

                                    while (($result = mysqli_fetch_assoc($save))) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $result['court']; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['start_datetime']; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['filename']; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['remarks']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <form method="post" enctype="multipart/form-data">
        <?php
        // If submit button is clicked
        if (isset($_POST['submit'])) {
            // get name from the form when submitted
            $name = $_POST['name'];

            if (isset($_FILES['pdf_file']['name'])) {
                // If the ‘pdf_file’ field has an attachment
                $file_name = $_FILES['pdf_file']['name'];
                $file_tmp = $_FILES['pdf_file']['tmp_name'];

                // Move the uploaded pdf file into the pdf folder
                move_uploaded_file($file_tmp, "./pdf/" . $file_name);
                // Insert the submitted data from the form into the table
               // $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`,`filename`) VALUES ('$title','$description','$start_datetime','$end_datetime','$file_name')";
               $sql = "INSERT INTO `schedule_lists` (`courttypes`,`start_datetime`,`filename`,`remarks`) VALUES ('$courttypes','$start_datetime''$filename','$remarks')";

                // Execute insert query
                $save = $conn->query($sql);

                if ($save) {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show text-center">
                        <a class="close" data-dismiss="alert" aria-label="close">
                            ×
                        </a>
                        <strong>Success!</strong> Data submitted successfully.
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center">
                        <a class="close" data-dismiss="alert" aria-label="close">
                            ×
                        </a>
                        <strong>Failed!</strong> Try Again!
                    </div>
                    <?php
                }
            } 
            else 
            {
                ?>

                <?php
            } // end if
        } // end if
        ?>


    </form>

    <script type="text/javascript" src="dist/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="dist/js/popper.min.js"></script>
    <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="dist/js/datatables.min.js"></script>

    <script>
        $(document).ready(function ()
        {
            $('#EventDataTbl').DataTable();
        });
    </script>


</body>

</html>