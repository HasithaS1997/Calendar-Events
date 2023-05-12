<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to use Full Calendar with MySQL in PHP? - Nicesnippets.com</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">

    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .fc-toolbar-title {
            font-size: 14px !important;
        }

        .fc-prev-button {
            padding: 3px !important;
            margin-left: 10px;
        }

        .fc-next-button {
            padding: 3px !important;
        }

        .fc-today-button {
            padding: 3px !important;
        }

        .fc-dayGridMonth-button {
            padding: 3px !important;
            margin-left: 10px;
            margin-right: 5px;
        }

        .fc-dayGridWeek-button {
            padding: 2px !important;
            margin-right: 4px;
        }

        .fc-list-button {
            padding: 2px !important;
            margin-right: 4px;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 2px !important;
            width: 0px;
        }

        .title {
            font-size: 30px;
        }


        body {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            font-family: "Helvetica Nueue", Arial, Verdana, sans-serif;
            background-color: #DDDDDD;
        }
    </style>
</head>

<body class="bg-light">

    <?php
    require_once('db-connect.php');

    // $schedules = $conn->query("SELECT * FROM `schedule_lists`");
    $sched_res = [];

    // foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
    //     $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
    //     //$row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    //     $sched_res[$row['id']] = $row;
    // }
    
    // if (isset($conn))
    //     $conn->close();
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <a class="navbar-brand title" href="#">Event Calendar</a>
                </div>
            </div>
        </div>
    </nav>


    <script>

        updateCalender({})

        $(document).ready(function () {


            const parentdiv = $('.fc-toolbar-chunk').eq(1);

            $(parentdiv).html('');

            const bttndiv = $('#test123');


            const ButtonGrp = '<div class="btn-group">' +
                '<button onclick="GetData(`Supreme`)" type="button" class="fc-dayGridMonth-button btn btn-primary" style="background-color:#FFC72C;font-color:black;">Supreme Court</button>' +
                '<button onclick="GetData(`Magistrate`)" type="button" class="fc-dayGridWeek-button btn btn-primary mx-3" style="background-color:#012169;">Magistrate Court</button>' +
                '<button onclick="GetData(`Appeal`)" type="button" class="fc-list-button btn btn-primary">Appeal Court</button>' +
                '</div>';

            $(bttndiv).append(ButtonGrp);


        });
    </script>

    <div class="container py-5" id="page-container">
        <div class="col-md-4">
            <div id="test123"></div>
            <div id="date123" class="text-center"></div>
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <!--  <label>Document Download : </label><a href="CauseList.pdf" download>Download Pdf</a> -->
                            <dt class="text-muted">Court Type</dt>
                            <dd id="court" class="fw-bold fs-4"></dd>
                            <!-- <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd> -->
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">File</dt>
                            <dd id="filename" class=""></dd>
                            <dt class="text-muted">Remarks</dt>
                            <dd id="remarks" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit"
                            data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete"
                            data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="js/script.js"></script>

    <script>



        updateCalender({})

        $(document).ready(function () {


            const parentdiv = $('.fc-toolbar-chunk').eq(1);

            //fc-toolbar-title

            $(parentdiv).html('');

            const bttndiv = $('#test123');

            const ButtonGrp = '<div class="btn-group mb-2">' +
                '<button onclick="GetData(`Supreme`)" type="button" class="btn btn-primary" style="background-color:#FFC72C;color:black;">Supreme Court</button>' +
                '<button onclick="GetData(`Magistrate`)" type="button" class="btn btn-primary mx-2" style="background-color:#012169;">Magistrate Court</button>' +
                '<button onclick="GetData(`Appeal`)" type="button" class="btn btn-primary" style="background-color:#012169;">Appeal Court</button>' +
                '</div>';

            $(bttndiv).append(ButtonGrp);


        });




        function GetData(court) {
            $.ajax({
                url: 'get_data.php?Court=' + court,
                method: 'GET',
                /*  contentType: 'application/json',
                 data: null,
                 dataType: 'json', */
                success: function (Response) {
                    var response = JSON.parse(Response);
                    var dataArr = createDataArray(response);
                    console.log(dataArr)
                    updateCalender(dataArr);
                    // $('.fc-toolbar-title').html('')

                    /*   $('#date123').html( $('.fc-toolbar-title').html());
                      $('#date123').html( $('.').html());
                      $('#date123').html( $('.').html());
                      $('#date123').html( $('.').html());
                      $('#date123').html( $('.').html());
                      $('#date123').html( $('.').html());
  
                      $('.fc-toolbar-title').html(''); */


                },
                error: function (Error) {
                    console.log('GetData.Response.Error:', Error);
                }
            });
        }

        function createDataArray(dataArray) {
            var data = {}
            if (!!dataArray) {
                dataArray.map(value => {
                    val = {
                        "id": value['id'],
                        "court": value['court'],
                        "start_datetime": value['datetime'],
                        "filename": value['filename'],
                        "remarks": value['remarks'],
                        "filname": value['filename']
                    }
                    data[value['id']] = val;
                })
            }
            return data;

        }

        // var calendar;
        // var Calendar = FullCalendar.Calendar;

        // Calendar.removeAllEvents();

        // console.log(CalendarEvents,calendar);

    </script>






</body>

</html>