@extends('admin.layouts.layout-basic')

@section('styles')
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
    <script src="/assets/admin/js/pages/datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"
        integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous">
    </script>
    <script>
        $(function() {
            init();

            function init() {
                $('.autocomplete_off').attr('autocomplete', 'off');
            }

            $('.delete').click(function() {
                var id = $(this).siblings('.employee_id').attr('id');
                $('#form-d-employee').attr('action', '/admin/employees/' + id + '/delete');
            });

            $('#showAllButtons').click(function() {
                $('#hiddenButtons').toggle();
            });
        });
    </script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Category <small class="text-muted">management</small></h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Employee List</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="caption">
                            <h6>Employee List</h6>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="responsive-datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Job Title</th>
                                    <th>Employment Status</th>
                                    <th>Shift</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $employee)
                                    <tr role="row">
                                        <td>{{ $employee->id_number }}</td>
                                        <td>{{ $employee->f_name }} {{ $employee->l_name }}</td>
                                        @if (\App\JobHistory::where('employee_id', $employee->id)->exists())
                                            <td>{{ \App\Department::where('id', \App\JobHistory::where('employee_id', $employee->id)->first()->department_id)->first()->name }}
                                            </td>
                                            <td>{{ \App\JobTitle::where('id', \App\JobHistory::where('employee_id', $employee->id)->first()->title_id)->first()->title }}
                                            </td>
                                            <td>{{ \App\EmployeeStatus::where('id', \App\JobHistory::where('employee_id', $employee->id)->first()->status_id)->first()->status }}
                                            </td>
                                            <td>{{ \App\WorkShift::where('id', \App\JobHistory::where('employee_id', $employee->id)->first()->shift_id)->first()->name }}
                                            </td>
                                        @else
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        @endif
                                        <td>
                                            <div class="btn-group mr-2" role="group">
                                                <input type="hidden" class="employee_id" id="{{ $employee->id }}">
                                                <button type="button" class="btn btn-icon btn-outline-info"
                                                    onclick="location.href='{{ route('employees.show', $employee->id) }}'">
                                                    <i class="icon-fa icon-fa-search"></i>
                                                </button>

                                                <button type="button" class="btn btn-icon btn-outline-danger delete"
                                                    data-toggle="modal" data-target="#modal-delete">
                                                    <i class="icon-fa icon-fa-trash"></i>
                                                </button>

                                                <form action="{{ route('attendance.clock-in') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                                    <button type="submit" class="btn btn-icon btn-outline-success">
                                                        <i class="icon-fa icon-fa-clock-o"></i> Clock In
                                                    </button>
                                                </form>

                                                <form action="{{ route('attendance.clock-out') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                                    <button type="submit" class="btn btn-icon btn-outline-danger">
                                                        <i class="icon-fa icon-fa-clock-o"></i> Clock Out
                                                    </button>
                                                </form>

                                                {{-- <form action="{{ route('attendance.mark') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                                    <button type="submit" class="btn btn-icon btn-outline-primary">
                                                        <i class="icon-fa icon-fa-check"></i> Mark Attendance
                                                    </button>
                                                </form> --}}

                                                <button type="button" class="btn btn-icon btn-outline-info"
                                                    data-toggle="modal" data-target="#viewAttendanceModal">
                                                    <i class="icon-fa icon-fa-eye"></i> View Attendance
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No employees found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        @include('admin.employees.delete')
    </div>

    <div class="modal fade" id="viewAttendanceModal" tabindex="-1" role="dialog"
        aria-labelledby="viewAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAttendanceModalLabel"> All Attendance Records</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="attendanceRecords">
                        <h4>Attendance Records</h4>
                        @foreach ($employees as $employee)
                            <ul>
                                <h2>
                                    <li>Employee Name: {{ $employee->f_name }} {{ $employee->l_name }}</li>
                                </h2>
                                @if (isset($employee->attendanceRecords) && count($employee->attendanceRecords) > 0)
                                    @foreach ($employee->attendanceRecords as $record)
                                        <li>{{ $record->date }} - Office in time
                                            {{ \Carbon\Carbon::parse($record->clock_in)->format('h:i A') }} - Office Out
                                            time {{ \Carbon\Carbon::parse($record->clock_out)->format('h:i A') }}</li>
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
@endsection
