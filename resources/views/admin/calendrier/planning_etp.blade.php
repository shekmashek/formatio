@extends('./layouts/admin')


@push('extra-links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
{{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

{{-- import all locale of fullCalendar --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script>


@endpush

@section('planningEtp')

 <div class="row">
    <div class="col-md-6 m-2">
        <div id="planning">

        </div>
    </div>
 </div>
    <script>
    $(document).ready(function() {
                $('#planning').fullCalendar({
                    locale: '{{ app()->getLocale() }}',
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,listWeek,listMonth'
                    },
                })
            });
    </script>


@endsection