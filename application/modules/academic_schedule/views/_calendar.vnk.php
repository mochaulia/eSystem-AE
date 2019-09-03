<div id="calendar"></div>
<script type="text/javascript">
    $('#calendar').fullCalendar({
        <?php if ($this->privileges_model->is(user()->id, 'create', $this->menus_model->select(array('alias' => 'academic_schedule'))->id)): ?>
        selectable: true,
        <?php endif;?>
        <?php if ($this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => 'academic_schedule'))->id)) : ?>
        editable: true, 
        <?php endif; ?>
        eventLimit: 3,
        displayEventTime: false,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: null,
            // right: 'month,agendaWeek,agendaDay,listWeek'
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
                            year: $('select#yearShow').val(),
                            class: $('select#classShow').val(),
                        },
                        success: function (data) {
                            var events = data.events;
                            callback(events);
                        }
                    });
                }
            },
        ],
        <?php if ($this->privileges_model->is(user()->id, 'create', $this->menus_model->select(array('alias' => 'academic_schedule'))->id)) : ?>
        select: function (startDate, endDate) {
            $('#modalCreate').modal();
            $('#dateTempCreate').append(
                $('<input>', {
                    type: 'hidden',
                    id: 'startDateTemp',
                    name: 'startDateTemp',
                    val: startDate.format()
                })
            );
            $('#dateTempCreate').append(
                $('<input>', {
                    type: 'hidden',
                    id: 'endDateTemp',
                    name: 'endDateTemp',
                    val: endDate.format()
                })
            );
        },
        <?php endif; ?>
        <?php if ($this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => 'academic_schedule'))->id)) : ?>
        eventClick: function(event, jsEvent, view) {
            $('#uniqueTempUpdate').append(
                $('<input>', {
                    type: 'hidden',
                    id: 'uniqueTemp',
                    name: 'uniqueTemp',
                    val: event.id
                })
            );
            $('#modalEdit').modal();
        },
        <?php endif; ?>
        <?php if ($this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => 'academic_schedule'))->id)) : ?>
        eventDrop: function(event, delta, revertFunc) {
            $.ajax({
                type: 'post',
                url: MENUS_URL + 'ajax_drag_events',
                cache: false,
                data: {
                    id: event.id,
                    start: event.start.format(),
                    end:  event.end.format(),
                },
                success: function (data) {
                    console.log(data);
                }
            });
        },
        <?php endif; ?>
        eventRender: function (event, element) {
            element.tooltip({title: event.title});
            element.find('.fc-content').attr('style', 'text-align:center;');
            element.find('.fc-title').attr('style', 'font-weight:bold;font-size:1.3em !important');
            <?php if ($this->privileges_model->is(user()->id, 'delete', $this->menus_model->select(array('alias' => 'academic_schedule'))->id)) : ?>
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
                                text: 'Data has been deleted successfully',
                                type: 'success',
                            });
                            $('#calendar').fullCalendar('removeEvents', event._id);                            
                        }
                    }
                });
            });
            <?php endif; ?>
        }
    });
</script>