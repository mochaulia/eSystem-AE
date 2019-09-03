<div id="calendar"></div>
<script type="text/javascript">
    $('#calendar').fullCalendar({
        slotLabelFormat: [
            'HH:mm'
        ],
        minTime: '07:00:00',
        maxTime: '22:00:00',
        defaultView: <?php echo (is_admin()) ? '"month"' : '"agendaWeek"' ?>,
        selectable: true,
        eventLimit: 3,
        displayEventTime: false,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        eventSources: [
            {
                events: function (start, end, timezone, callback) {
                    $.ajax({
                        url: MENUS_URL + 'ajax_get_events',
                        dataType: 'json',
                        data: {
                            start: start.unix(),
                            end: end.unix(),
                            my: $('select#myShow').val(),
                            status: $('select#statusShow').val(),
                            room: $('select#roomsShow').val()
                        },
                        success: function (data) {
                            var events = data.events;
                            callback(events);
                        }
                    });
                }
            },
        ],
        <?php if ($this->privileges_model->is(user()->id, 'create', $this->menus_model->select(array('alias' => 'room_renting'))->id)) : ?>
        select: function (startDate, endDate) {
            $('#modalCreate').modal();
            $('#dateTempCreate').append(
                $('<input>', {
                    type: 'hidden',
                    id: 'startDateTemp',
                    name: 'startDateTemp',
                    val: moment(startDate).format('YYYY-MM-DD HH:mm:ss')
                })
            );
            $('#dateTempCreate').append(
                $('<input>', {
                    type: 'hidden',
                    id: 'endDateTemp',
                    name: 'endDateTemp',
                    val:  moment(endDate).format('YYYY-MM-DD HH:mm:ss')
                })
            );
        },
        <?php endif; ?>
        eventRender: function (event, element) {
            var id_user = <?php echo user()->id; ?>;
            var is_delete = <?php echo ($this->privileges_model->is(user()->id, 'delete', $this->menus_model->select(array('alias' => 'room_renting'))->id)) ? 'true' : 'false' ;?>;
            var is_admin = <?php echo (is_admin()) ? 'true' : 'false'; ?>;
            element.find('.fc-content').css('white-space', 'normal');
            element.find('.fc-title').css('line-height', '1');
            element.find('.fc-title').css('font-size', '1.15em');
            var title_old = element.find('.fc-title').html();
            var res =
                '<strong><em>Room</em></strong>: ' + 
                '<u>' + title_old.split('~')[0] + '</u>' +
                '<br/>' +
                '<strong><em>Time</em></strong>: ' + 
                '<u>' +
                moment(title_old.split('~')[3]).format('DD-MM-YYYY HH:mm') + 
                '</u> untill <u>' + 
                moment(title_old.split('~')[4]).format('DD-MM-YYYY HH:mm') + 
                '</u>' +
                '<br/>' +
                '<strong><em>Status</em></strong>: ' + 
                title_old.split('~')[5];
            element.find('.fc-title').html(res);
            if (event.id_user == id_user || is_delete || is_admin) {
                element.append('<div style="">' +
                               '<span class="closeon fa fa-times fa-2x" ' + 
                               'style="position:absolute;' +
                               'top:-10px;' +
                               'right:-10px;' +
                               'text-shadow: 0px 0px 5px #000000;">' +
                               '</span>' +
                               '</div>');
                element.find('.closeon').click(function() {
                    $('#calendar').fullCalendar('removeEvents', event._id);
                    $.ajax({
                        type: 'post',
                        url: MENUS_URL + 'ajax_delete_events',
                        cache: false,
                        data: {
                            id: event.id,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == 'deleted') {
                                new PNotify({
                                    title: 'Deleted',
                                    text: 'Booking has been deleted successfully',
                                    type: 'success',
                                });
                                $('#calendar').fullCalendar('removeEvents', event._id);                            
                            }
                        }
                    });
                });
            }            
        },
        eventClick: function(event, jsEvent, view) {
            $('#uniqueTempUpdate').append(
                $('<input>', {
                    type: 'hidden',
                    id: 'uniqueTemp',
                    name: 'uniqueTemp',
                    val: event.id
                })
            );
            $('#modalRead').modal();
        },
    });
</script>