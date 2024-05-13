<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add New Project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('inventory.store') }}" id="from-product" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Project Name<span class="required" aria-required="true">*</span></label>
                                    <input type="text" name="p_name" value="" class="form-control input-md"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-group-bottom">
                                    <label>Client Name <span class="required" aria-required="true">*</span></label>
                                    <input type="text" name="p_owner" class="form-control input-md" value=""
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-bottom">
                                    <label>Country <span class="required" aria-required="true">*</span></label>
                                    <input type="text" name="Country" class="form-control input-md" value=""
                                        required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category <span class="required" aria-required="true">*</span></label>
                                    <select class="form-control ls-select2" name="category" style="width:100%;"
                                        required>

                                        @if (!$categories->isEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Please Select</option>
                                        @endif
                                    </select>
                                    <a href="#" data-toggle="modal" data-target="#modal_create_category">+ Add
                                        Category</a>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group form-group-bottom">
                            <label>Total Budget <span class="required" aria-required="true">*</span></label>
                            <input type="text" name="total_budget" placeholder="0.00" class="form-control input-md"
                                value="" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Milestone</label>
                            <textarea type="text" name="get_budget" placeholder="Milestone Details" class="form-control input-md"></textarea>

                            {{-- <input type="text" name="get_budget" placeholder="0.00" class="form-control input-md"
                                value=""> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Remaining Amount</label>
                            <textarea class="form-control input-md" name="ramain_budget" placeholder="0.00"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Meeting</label>
                            <input type="text" name="meeting" class="form-control input-md" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="start_time" class="form-control input-md" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dead Line</label>
                            <input type="date" name="deadline" class="form-control input-md" value="">
                        </div>
                    </div>
                </div>
                
               
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="">
                <input type="hidden" class="type" name="type" value="">
                <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Save Product</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal_create_category" style="display: none;">
    @include('admin.category.create')
</div>
