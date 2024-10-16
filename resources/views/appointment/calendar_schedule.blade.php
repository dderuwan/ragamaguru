@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center pl-5 pr-5">

      <div class="col-md-12">
        <h2 class="text-center">Work Schedule Calendar</h2>

        <div class="text-center mb-3">
          <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 20px;">
          <div style="background-color: #ffffb3; padding: 5px 10px; border-radius: 5px;">First Day Visit</div>
            <div style="background-color: #b3d9ff; padding: 5px 10px; border-radius: 5px;">Second Day Visit</div>
            <div style="background-color: #99ffbb; padding: 5px 10px; border-radius: 5px;">Third Day Visit</div>
            <div style="background-color: #ffccb3; padding: 5px 10px; border-radius: 5px;">Bookings</div>
          </div>
        </div>

        <!-- Calendar -->
        <div id="calendar"
          data-first-visit-dates="{{ json_encode($firstVisitDates) }}"
          data-second-visit-dates="{{ json_encode($secondVisitDates) }}"
          data-third-visit-dates="{{ json_encode($thirdVisitDates) }}"
          data-apBookings="{{ json_encode($apBookings) }}">
        </div>

      </div>

    </div>
  </div>
</main>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/daygrid.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/interaction.min.js"></script>




<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarElement = document.getElementById('calendar');

    var firstVisitDates = JSON.parse(calendarElement.getAttribute('data-first-visit-dates'));
    var secondVisitDates = JSON.parse(calendarElement.getAttribute('data-second-visit-dates'));
    var thirdVisitDates = JSON.parse(calendarElement.getAttribute('data-third-visit-dates'));
    var apBookings = JSON.parse(calendarElement.getAttribute('data-apBookings'));

    var events = [
      ...firstVisitDates.map(item => ({
        title: item.title,
        start: item.date,
        color: item.color
      })),
      ...secondVisitDates.map(item => ({
        title: item.title,
        start: item.date,
        color: item.color
      })),
      ...thirdVisitDates.map(item => ({
        title: item.title,
        start: item.date,
        color: item.color
      })),
      ...apBookings.map(item => ({
        title: item.title,
        start: item.date,
        color: item.color
      }))
    ];

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ['dayGrid', 'interaction'],
      initialView: 'dayGridMonth',
      events: events
    });
    calendar.render();
  });
</script>


@endsection