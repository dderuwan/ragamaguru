@extends('layouts.main.master')

@section('content')
<style>
    /* Toggle switch styling */
    .switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(14px);
    }

    .fc-day.blocked {
        background-color: rgba(255, 0, 0, 0.3);
    }

    .fc-day {
        position: relative;
        font-size: 0.7rem; 
    }

    .date-block-toggle {
        position: absolute;
        bottom: 5px;
        right: 5px;
    }

    #calendar {
        font-size: 12px; 
        max-width: 1000px; 
        margin: auto;
    }

    .fc-day-grid-container {
        height: 600px; 
    }

.fc button {
    justify-content: center;   
    align-items: center;       
    background-color: #007bff; 
    color: #fff;              
    border: none;              
    padding: 5px 10px;         
    border-radius: 4px;        
    margin: 0 5px;            
    font-size: 14px;           
    height: 30px;               
}

.fc button:hover {
    background-color: #0056b3; 
}

.fc button:active {
    background-color: #004080; 
}

.fc-prev-button::before,
.fc-next-button::before {
    font-family: "FontAwesome";
    font-weight: normal;
    display: inline-block;       
}

.fc-prev-button::before {
    content: "\f104"; 
    margin-left: 10px;
}

.fc-next-button::before {
    content: "\f105"; 
    margin-left: 10px;
}



</style>


<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h2 class="page-title">Block Booking Dates</h2>
                    </div>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div id="calendar" data-blocked-dates="{{ json_encode($blockedDates) }}">
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
    $(document).ready(function () {
        var calendarElement = document.getElementById('calendar');
        var blockedDates = JSON.parse(calendarElement.getAttribute('data-blocked-dates'));

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',  
                center: 'title',
                right: ''  
            },
            editable: true,
            selectable: false,
            selectHelper: true,
            height: 600,  
            aspectRatio: 1.5,  
            dayRender: function (date, cell) {
                var dateString = date.format('YYYY-MM-DD');
                var isBlocked = blockedDates.includes(dateString);

                // Add a toggle switch button in each date cell
                var toggleHtml = `
                    <div class="date-block-toggle">
                        <label class="switch">
                            <input type="checkbox" class="toggle-block" data-date="${dateString}" ${isBlocked ? 'checked' : ''}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                `;
                cell.append(toggleHtml);
                if (isBlocked) {
                    cell.addClass('blocked');
                }
            },
        });

        $('#calendar').on('change', '.toggle-block', function () {
            var date = $(this).data('date');
            var action = $(this).is(':checked') ? 'block' : 'unblock';

            $.ajax({
                url: '/admin/blocked-dates/' + action,
                method: 'POST',
                data: {
                    date: date,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (action == 'block') {
                        blockedDates.push(date);
                        $(`.fc-day[data-date='${date}']`).addClass('blocked');
                    } else {
                        blockedDates = blockedDates.filter(d => d !== date);
                        $(`.fc-day[data-date='${date}']`).removeClass('blocked');
                    }
                },
                error: function () {
                    alert('Error occurred. Please try again.');
                }
            });
        });
    });
</script>
@endsection
