<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('inventory.update', ['inventory' => $inventory->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Project Name<span class="required" aria-required="true">*</span></label>
                                        <input id="inp_p_name" type="text" name="p_name" value="" class="form-control input-md">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-bottom">
                                        <label>Project Owner <span class="required" aria-required="true">*</span></label>
                                        <input id="inp_p_owner" type="text" name="p_owner" class="form-control input-md" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-bottom">
                                        <label>Country <span class="required" aria-required="true">*</span></label>
                                        <input id="inp_Country" type="text" name="Country" class="form-control input-md" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category <span class="required" aria-required="true">*</span></label>
                                        <select id="inp_category" class="form-control input-md ls-select2" name="category" style="width: 50%;">
                                            @if (!$categories->isEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Please Select</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-bottom">
                                        <label>Total Budget <span class="required" aria-required="true">*</span></label>
                                        <input id="inp_total_budget" type="text" name="total_budget" placeholder="0.00" class="form-control input-md" value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Milestone</label>
                                        <textarea id="inp_get_budget" type="text" name="get_budget" placeholder="Milestone Details" class="form-control input-md"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Remaining Amount</label>
                                        <textarea id="inp_ramain_budget" class="form-control input-md" name="ramain_budget" placeholder="0.00"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Meeting</label>
                                        <input id="inp_meeting" type="text" name="meeting" class="form-control input-md" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input id="inp_start_time" type="date" name="start_time" class="form-control input-md" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dead Line</label>
                                        <input id="inp_deadline" type="date" name="deadline" class="form-control input-md" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="type" value="Inventory">

                <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i> Update Project</button>
            </div>
        </form>
    </div>
</div>
