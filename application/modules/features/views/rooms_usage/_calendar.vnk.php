<div id="calendar"></div>
<script type="text/javascript">
    $('#calendar').fullCalendar({
        slotLabelFormat: [
            'HH:mm'
        ],
        minTime: '07:00:00',
        maxTime: '22:00:00',
        defaultView: 'month',
        eventLimit: 5,
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
                        url: 'rooms_usage/ajax_get_events',
                        dataType: 'json',
                        data: {
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function (data) {
                            var events = data.events;
                            callback(events);
                        }
                    });
                }
            },
        ],
        eventRender: function (event, element) {
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
                '</u>';
            element.find('.fc-title').html(res);
        }
    });
</script>