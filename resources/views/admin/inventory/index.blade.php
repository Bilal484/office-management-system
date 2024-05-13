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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function init() {

        }
        init();

        $('.edit').click(function() {
            var id = $(this).siblings('.inventory_id').attr('id');
            $('#form-inventory').attr('action', '/admin/inventory/' + id);

            $.get("/admin/inventory/" + id + "/edit", function(data) {
                $('#inp_p_name').val(data['inventory'][0]['p_name']);
                $('#inp_p_owner').val(data['inventory'][0]['p_owner']);
                $('#inp_Country').val(data['inventory'][0]['Country']);
                $('#inp_category').val(data['inventory'][0]['category_id']);
                $('#inp_total_budget').val(data['inventory'][0]['total_budget']);
                $('#inp_get_budget').val(data['inventory'][0]['get_budget']);
                $('#inp_ramain_budget').val(data['inventory'][0]['ramain_budget']);
                $('#inp_start_time').val(data['inventory'][0]['start_time']);
                $('#inp_deadline').val(data['inventory'][0]['deadline']);
                $('#inp_meeting').val(data['inventory'][0]['meeting']);
            });
        });

        $('.delete').click(function() {
            var id = $(this).parents('li').siblings('.inventory_id').attr('id');
            $('#form-d-inventory').attr('action', '/admin/inventory/' + id);
        });

        $('.inventory').click(function() {
            $('.type').val('Inventory');
        });
        $('.n_inventory').click(function() {
            $('.type').val('Non-Inventory');
            $('.quantity').hide();
        });
        $('.service').click(function() {
            $('.type').val('Service');
            $('.quantity').hide();
        });

        $(document.body).on('click', '.withdraw', function() {
            var id = $(this).siblings('.inventory_id').attr('id');
            $('.inv_id').val(id);
            $.get("/admin/inventory/" + id, function(data) {
                $('#w_quantity').attr('placeholder', data['quantity']);
                $('#withdraw_name').val(data['name']);
            });
        });


        $(document.body).on('keyup', '#w_quantity', function() {
            $limit = $('#w_quantity').attr('placeholder');
            $inp = $(this).val();
            if (parseInt($(this).val()) > parseInt($limit)) {
                $('#exceed_qty').attr('class', '');
                $('#submit_withdraw').attr('disabled', 'disabled');
            } else {
                $('#exceed_qty').attr('class', 'hidden');
                $('#submit_withdraw').removeAttr('disabled');
            }
        });

        $(document.body).on('change', '#parent_present', function() {
            if (this.checked) {
                $('.child_present').prop('checked', true);
            } else {
                $('.child_present').prop('checked', false);
            }
        });
    </script>
@stop
@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Codesinc <small class="text-muted">Management</small></h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('inventory.index') }}">Projects</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="card">
                    <form action="{{ route('inventory.delete') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="card-header bg-info">
                            <div class="caption">
                                <h6>Projects</h6>
                            </div>
                            <div class="actions">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-default btn-sm"
                                    data-toggle="modal" data-target="#modal-create">
                                    Add Project
                                </button>
                                <button type="submit"
                                    onclick="return confirm('Are you sure want to delete selected inventories?');"
                                    class="btn btn-danger btn-md btn-flat btn-sm" id="deleteInventories">
                                    <i class="fa fa-trash"></i>Delete
                                </button>
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table id="responsive-datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr role="row">
                                        <th><input type="checkbox" id="parent_present">No.</th>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Client Name</th>
                                        <th>Country</th>
                                        <th>Total Budget</th>
                                        <th>Milestone</th>
                                        <th>Remaining Amount</th>
                                        <th>Meetings</th>
                                        <th>Start Date</th>
                                        <th>Deadline</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                @if (!$inventories->isEmpty())
                                    <tbody>
                                        @if (Session::has('success'))
                                            <!-- Add your success message display here -->
                                        @endif
                                        @if (Session::has('failure'))
                                            <!-- Add your failure message display here -->
                                        @endif
                                        @if (Session::has('warning'))
                                            <!-- Add your warning message display here -->
                                        @endif
                                        @foreach ($inventories as $index => $inventory)
                                            <tr role="row" class="odd">
                                                <td>{{ $index + 1 }}<br><input type="checkbox"
                                                        class="child_present pull-left" name="inventory[]"
                                                        value="{{ $inventory->id }}"></td>

                                                <td>{{ $inventory->p_name }}</td>
                                                <td>{{ $inventory->category($inventory->id) }}</td>
                                                <td>{{ $inventory->p_owner }}</td>
                                                <td>{{ $inventory->Country }}</td>
                                                <td>{{ $inventory->total_budget }}</td>
                                                <td>{{ $inventory->get_budget }}</td>
                                                <td>{{ $inventory->ramain_budget }}</td>

                                                <td>{{ $inventory->meeting }}</td>
                                                <td>{{ $inventory->start_time }}</td>
                                                <td>{{ $inventory->deadline }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button"
                                                            class="btn btn-sm btn-outline-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <input type="hidden" class="inventory_id"
                                                                id="{{ $inventory->id }}">
                                                            <a class="dropdown-item edit" href="#" data-toggle="modal"
                                                                data-target="#modal-edit">Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody>
                                        <div class="card text-white bg-info text-sm-center">
                                            <div class="card-body">
                                                <blockquote class="card-bodyquote">
                                                    <p>Hi, you don't have any Project yet</p>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-create" style="display: none;">
        @include('admin.inventory.create')
    </div>
    <div class="modal fade" id="modal-edit" style="display: none;">
        @include('admin.inventory.edit')
    </div>
    <div class="modal fade" id="modal-delete" style="display: none;">
        @include('admin.inventory.delete')
    </div>

    <!-- /.row (main row) -->
@endsection
