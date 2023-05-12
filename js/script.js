function updateCalender(scheds) {
    var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];

    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k]
            events.push({ id: row.id, court: row.court, start: row.start_datetime, filename: row.filename, remarks: row.remarks });
        });
    }

    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear(),



        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'previous,next today',
                right: 'dayGridMonth,dayGridWeek,list',
                height: '400px',
                center: 'title',
            },

            initialView: 'dayGridMonth',
            height: '600px',
            width: '300px',
            events: '',

            selectable: true,
            //selectHelper:true,
            themeSystem: 'bootstrap',
            events: events,
            eventClick: function (info) {
                // var details = $('#event-details-modal');
                var id = info.event.id;

                if (!!scheds[id]) {
                    /*details.find('#title').text(scheds[id].title);
                      details.find('#description').text(scheds[id].description);
                      details.find('#start').text(scheds[id].sdate);
                      details.find('#end').text(scheds[id].edate);
                      details.find('#edit,#delete').attr('data-id', id); */


                    // details.find('#court').text(scheds[id].court);
                    // details.find('#start').text(scheds[id].sdate);
                    // details.find('#filename').text(scheds[id].filename);
                    // details.find('#remarks').text(scheds[id].remarks);
                    // details.find('#edit,#delete').attr('data-id', id);
                    // details.modal('show');

                    // Set download file
                    var file_path = 'pdf/' + scheds[id].filename;
                    var pdfDownloadLink = document.createElement('a');
                    pdfDownloadLink.href = file_path;
                    pdfDownloadLink.download = scheds[id].filename;
                    pdfDownloadLink.dispatchEvent(new MouseEvent('click'));
                }
                else 
                {
                    alert("Event is undefined");
                }
            },
            eventDidMount: function (info) {
                // Do Something after events mounted
            },
            editable: true
        });

    calendar.render();


    // Form reset listener
    $('#schedule-form').on('reset', function () {
        $(this).find('input:hidden').val('');
        $(this).find('input:visible').first().focus();
    });

    // Edit Button
    $('#edit').click(function () {
        var id = $(this).attr('data-id');

        if (!!scheds[id]) {
            var form = $('#schedule-form');

            console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"));
            form.find('[name="id"]').val(id);
            form.find('[name="court"]').val(scheds[id].court);
            form.find('[name="description"]').val(scheds[id].description);
            form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"));
            form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"));
            // $('#event-details-modal').modal('hide');
            form.find('[name="title"]').focus();
        }
        else {
            alert("Event is undefined");
        }
    });

    // Delete Button / Deleting an Event
    $('#delete').click(function () {
        var id = $(this).attr('data-id');

        if (!!scheds[id]) {
            var _conf = confirm("Are you sure to delete this scheduled event?");
            if (_conf === true) {
                location.href = "./delete_schedule.php?id=" + id;
            }
        } else {
            alert("Event is undefined");
        }
    });


    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: '400px',
        width: '300px',
        events: ''
    });

};

