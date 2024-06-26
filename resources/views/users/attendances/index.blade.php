@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
    <script src="/assets/admin/js/pages/notifications.js"></script>
    <script src="/assets/admin/js/pages/datatables.js"></script>
    <script>
        init();

        function init() {
            $('.autocomplete_off').attr('autocomplete', 'off');
        }
        $(document.body).on('change', '#parentAttendanceCheckbox', function() {
            if (this.checked) {
                $('.child_present').prop('checked', true)
            } else {
                $('.child_present').prop('checked', false);
            }
        });

        $(document.body).on('change', '#parentLeaveCheckbox', function() {
            if (this.checked) {
                $('.child_absent').prop('checked', true)
            } else {
                $('.child_absent').prop('checked', false)
            }
        });

        $('.showYear').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
        });
    </script>
@stop
@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Attendance <small class="text-muted">management</small></h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('client.index') }}">Attendance</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="caption">
                            <h6>Attendance Report</h6>
                        </div>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('profiles.setAttendanceYear', $id) }}" class="form-horizontal" method="post"
                            accept-charset="utf-8">
                            @csrf
                            <div class="panel_controls">
                                <div class="form-group margin">
                                    <label class="col-sm-3 control-label">Year <span class="required">*</span></label>

                                    <div class="col-sm-5">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-fa icon-fa-calendar"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="date"
                                                class="form-control ls-datepicker autocomplete_off showYear" value=""
                                                data-date-format="yyyy-mm-dd" required>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" class="btn bg-olive btn-md btn-flat">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
