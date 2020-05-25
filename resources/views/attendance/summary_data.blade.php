<div class="white-box">
    <div class="table-responsive tableFixHead">
        <table class="table table-nowrap mb-0">
            <tbody>
            @foreach($final as $key => $attendance)
                @php
                    $totalPresent = 0;
                @endphp
                <tr>
                    <td> {!! end($attendance) !!} </td>
                   
                    @foreach($attendance as $key2=>$day)
                        @if ($key2+1 <= count($attendance))
                        <td class="text-center">
                                @if($day == 'Absent')
                                    <a href="javascript:;" class="edit-attendance p-2" data-toggle="modal" data-target="#markatModel" data-attendance-date="{{ $key2 }}"><i class="fa fa-times text-danger"></i></a>
                                @elseif($day == 'Holiday')
                                    <a href="javascript:;" class="edit-attendances p-2" data-attendance-date="{{ $key2 }}"><i class="fa fa-star text-warning"></i></a>
                                @else
                                    @if($day != '-')
                                        @php
                                            $totalPresent = $totalPresent + 1;
                                        @endphp
                                    @endif
                                    {!! $day !!}
                                @endif
                    </td>
                        @endif
                    @endforeach
                <td class="text-success">{{ $totalPresent .' / '.(count($attendance)-1) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>