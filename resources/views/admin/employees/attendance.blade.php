<div class="modal fade" id="viewAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="viewAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAttendanceModalLabel">My Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="attendanceRecords">
                    <h4>Attendance Records</h4>
                    @foreach ($employees as $employee)
                        <ul>
                            @if (isset($employee->attendanceRecords))
                                @foreach ($employee->attendanceRecords as $record)
                                    <li>{{ $record->date }} - Office in time {{ \Carbon\Carbon::parse($record->clock_in)->format('h:i A') }} - Office Out time {{ \Carbon\Carbon::parse($record->clock_out)->format('h:i A') }}</li>
                                @endforeach
                            @else
                                <li>No attendance records found</li>
                            @endif
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
