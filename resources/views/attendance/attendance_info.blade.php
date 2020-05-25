    <div class="row">
        <div class="col-md-6">
            <div class="card punch-status">
                <div class="white-box">
                    <h4> Attendance <small class="text-muted">{{ $startTime->format($global->date_format) }}</small></h4>
                    <div class="punch-det">
                        <h6> Clock In</h6>
                        @php
                            $startTime = Carbon\Carbon::parse($startTime,$global->timezone);
                            $endTime = Carbon\Carbon::parse($endTime,$global->timezone);
                        @endphp
                        <p>{{ $startTime->format($global->time_format) }}</p>
                    </div>
                    <div class="punch-info">
                        <div class="punch-hours">
                            <span>{{ $totalTime }} hrs</span>
                        </div>
                    </div>
                    <div class="punch-det">
                        <h6>Clock out</h6>
                        <p>{{ $endTime->format($global->time_format) }} 
                        @if (isset($notClockedOut))
                            (not ClockedOut)
                        @endif
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card recent-activity">
                <div class="white-box">
                    <h5 class="card-title">Activity</h5>

                        @foreach ($attendanceActivity->reverse() as $item)
                        @php
                            $item->clock_in_time = \Carbon\Carbon::parse($item->clock_in_time,$global->timezone);
                            $item->clock_out_time = \Carbon\Carbon::parse($item->clock_out_time,$global->timezone);
                        @endphp
                         <div class="row res-activity-box" id="timelogBox{{ $item->aId }}">
                            <ul class="res-activity-list col-md-9">
                                <li>
                                    <p class="mb-0">Clock In</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        {{ $item->clock_in_time->timezone($global->timezone)->format($global->time_format) }}.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0"> Clock Out</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        @if (!is_null($item->clock_out_time))
                                            {{ $item->clock_out_time->timezone($global->timezone)->format($global->time_format) }}.
                                        @else
                                           not Clock out
                                        @endif
                                    </p>
                                </li>
                            </ul>

                             <div class="col-md-3">
                                 <a href="javascript:;" onclick="editAttendance({{ $item->aId }})" style="display: inline-block;" id="attendance-edit" data-attendance-id="{{ $item->aId }}" ><label class="label label-info"><i class="fa fa-pencil"></i> </label></a>
                                 <a href="javascript:;" onclick="deleteAttendance({{ $item->aId }})" style="display: inline-block;" id="attendance-edit" data-attendance-id="{{ $item->aId }}" ><label class="label label-danger"><i class="fa fa-times"></i></label></a>
                             </div>
                         </div>
                        @endforeach

                </div>
            </div>
        </div>
    </div>

<script>
     function deleteAttendance(id){
         if(confirm("Are you Sure To Delete Attendance"))
         {
                var url = "{{ route('attendance.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        attendancetable.draw();
                    }
                });
        }  
    }

</script>