<div class="content-wrapper">    
    <section class="content-header">
      <h1>
       <i class="fa fa-users"></i> View Event Schedule
        <small>Event</small>
      </h1>
    </section>
    <section class="content" style="background-color: white;">
        <div class="row" style="padding: 10px 15px;">
            <div id="calendar"></div>
        </div>
    </section>

    

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay',
          },
          eventSources: [
                {
                     events: function(start, end, timezone, callback) {
                     $.ajax({
                     url: '<?php echo base_url() ?>calendar/get_events',
                     dataType: 'json',
                     data: {
                     // our hypothetical feed requires UNIX timestamps
                     start: start.unix(),
                     end: end.unix()
                     },
                     success: function(msg) {
                         var events = msg.events;
                         callback(events);
                     },
                     error: function() {
                    alert('there was an error while fetching events!');
                  }
                     });
                 }
                }
            ]
        });
    });
</script>
